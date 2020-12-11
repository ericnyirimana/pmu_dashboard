<?php

namespace App\Http\Controllers;

use App\Models\OrderPickup;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Payment;
use App\Models\SubscriptionTicket;
use App\Models\User;
use App\Services\EmailService;
use App\Services\PushNotificationService;
use Illuminate\Http\Request;
use App\Libraries\StripeIntegration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PromoSerialUsed;
use Carbon\Carbon;
use StdClass;
use App\Services\ApplicationService;

class TicketController extends Controller
{
    protected $emailService;
    protected $pusher;
    private $stripe;
    protected $applicationService;

    public function __construct(PushNotificationService $pusher, EmailService $emailService, StripeIntegration $stripe, ApplicationService $applicationService)
    {
        $this->pusher = $pusher;
        $this->emailService = $emailService;
        $this->stripe = $stripe;
        $this->applicationService = $applicationService;
    }

    public function validation(Request $request, $company = null)
    {

        $request->validate(
            [
                'restaurant_notes' => 'required',
            ]
        );

    }

    public function show(Request $request) {

        //Take ticket offer
        $ticket = OrderPickup::find($request->ticket);
        if ($ticket == null) {
            //Take ticket subscription
            $ticket = SubscriptionTicket::find($request->ticket);
        }

        if ($ticket) {
            return view('admin.tickets.view')->with([
                    'ticket'  => $ticket,
                ]
            );
        }

        abort(404);

    }

    /**
     * @param int $ticketId
     * @param string $restaurantNotes
     * @return bool
     */
    public function cancelTicketsById(Request $request, $ticketId){
        $ordersPickup = OrderPickup::where('id', $ticketId)
            ->where('closed', '=', 0)
            ->where('restaurant_status','=','ACCEPTED')->first();
        $fields = $request->all();
        if( $ordersPickup == null ){
            Log::info('OrderPickup not found with id: '. $ticketId);
            return response()->json(['error' => 'Ticket not found'], 404);
        }
        if(empty($fields['restaurant_notes'])){
            return response()->json(['error' => 'Restaurant note required'], 400);
        }
        $this->changeAmount($ordersPickup, $fields['restaurant_notes']);
        $this->cancelPayment($ordersPickup->order_id);
        $ordersPickupWithOrder = OrderPickup::where('id', $ticketId)->with('order')->first();
        $userCustomer = User::find($ordersPickupWithOrder->order->user_id);
        if($userCustomer){
            // Send cancel order email
            $this->emailService->sendEmailCancelOrder($userCustomer->first_name, $userCustomer->email,
            $userCustomer->id, $ordersPickupWithOrder);
            // Send PushNotification to the Customer
            Log::info('ORDER AND PICK NAME: '. $ordersPickup->pickup->name);
            Log::info('ORDER AND PICK NOTE: '. $ordersPickup->restaurant_notes);
            Log::info('ORDER AND PICK SUB: '. $userCustomer->sub);
            Log::info('ORDER AND PICK ID: '. $ordersPickup->id);
            $paramsPushNotification = array(
            "deal_name" => $ordersPickup->pickup->name,
            "notes"  => $ordersPickup->restaurant_notes
            );
            $this->pusher->sendPushNotificationToCustomer([strval($userCustomer->sub)],
                trans('push-notifications.ticket_reject.title', ["ticket_id" => $ordersPickup->id], "it"),
                trans('push-notifications.ticket_reject.message',
                    ["emoji" => html_entity_decode('&#128073;',ENT_NOQUOTES,'UTF-8')], "it"),
                $paramsPushNotification
            );
        } else {
            Log::warning('No Customer User found to send email: '. $ordersPickup->order->user_id);
        }

        return $ordersPickupWithOrder;

    }

    private function changeAmount($cancelledTicket, string $restaurantNotes){
        try {

            //Change restaurant_status to CANCELED
            $cancelledTicket->restaurant_status = 'CANCELED';
            $cancelledTicket->restaurant_notes = $restaurantNotes;
            $cancelledTicket->updated_at = Carbon::now();
            $cancelledTicket->save();

            $allTickets = OrderPickup::where('order_id', $cancelledTicket->order_id)->where('restaurant_status', '<>', 'CANCELED')->get();
            if( $allTickets->count() == 0){
                //If count == 0 there is only 1 ticket, and we have to cancel only the payment
                //CancelledTicket contains the PROMO_CODE
                if( $cancelledTicket->promo_code != null || $cancelledTicket->promo_code != '' ){
                    $promoSerialUsed = PromoSerialUsed::find($cancelledTicket->promo_serial_used_id);
                    $promoSerialUsed->used = 0;
                    $promoSerialUsed->save();

                    $cancelledTicket->promo_code = null;
                    $cancelledTicket->save();
                }
                return;
            }

            DB::beginTransaction();
            $orderPickups = new StdClass();
            $orderPickups->totalOrderAmount = (double) 0.00;
            $orderPickups->subTotalOrderAmount = (double) 0.00;
            $orderPickups->totalPmuFeeAmount = (double) 0.00;
            $orderPickups->totalRestaurantCommission = (double) 0.00;

            $isPromoCodeApplicable = false;
            $commissionToPay = 0;
            foreach ($allTickets as $ticket) {

                $promoCodePmu = (string) null;
                $promoSerialUsedId = null;

                //CancelledTicket contains the PROMO_CODE
                if( $cancelledTicket->promo_code != null || $cancelledTicket->promo_code != '' ){

                    if( $cancelledTicket->discounted_price > $ticket->total_amount ){
                        $isPromoCodeApplicable = false;
                        continue;
                    } else {
                        //Calculate the new value with the PROMO_CODE values
                        $isPromoCodeApplicable = true;
                        $discountedPrice = $cancelledTicket->discounted_price;
                        $fee = $cancelledTicket->fee;
                        $subTotalAmount = $ticket->offer_price * $ticket->quantity;
                        $totalAmount = $subTotalAmount - $cancelledTicket->discounted_price;
                        $pmuCommissionAmount = round(round($subTotalAmount * $fee) / 100, 2, PHP_ROUND_HALF_EVEN);
                        $restaurantCommission = $ticket->total_amount - $pmuCommissionAmount;

                        $promoSerialUsedId = $cancelledTicket->promo_serial_used_id;
                        $promoCodePmu = $cancelledTicket->promo_code;
                        $applicationFeeAmount = round($subTotalAmount * $fee);
                    }
                } else {
                    $discountedPrice = $ticket->discounted_price;
                    $fee = $ticket->fee;
                    $pmuCommissionAmount = $ticket->pmu_commission;
                    $restaurantCommission = $ticket->restaurant_commission;
                    $subTotalAmount = $ticket->offer_price * $ticket->quantity;
                    $totalAmount = $ticket->total_amount;
                    $applicationFeeAmount = round($subTotalAmount * $fee);
                }

                $orderPickups->totalPmuFeeAmount += $applicationFeeAmount;
                $orderPickups->totalRestaurantCommission += ($subTotalAmount - $pmuCommissionAmount);
                $orderPickups->totalOrderAmount += $totalAmount;
                $orderPickups->subTotalOrderAmount += $subTotalAmount;

                //Save OrderPickup
                $ticket->fee = $fee;
                $ticket->fee_not_discounted = $this->applicationService->getValue('FEE');;
                $ticket->promo_code = $promoCodePmu;
                $ticket->promo_serial_used_id = $promoSerialUsedId;
                $ticket->pmu_commission = $pmuCommissionAmount;
                $ticket->restaurant_commission = $restaurantCommission;
                $ticket->discounted_price = $discountedPrice;
                $ticket->total_amount = $totalAmount;
                $ticket->save();
            }

            //We apply the PROMO_CODE to another ticket
            if( $isPromoCodeApplicable ){
                if($orderPickups->totalRestaurantCommission >= $orderPickups->totalOrderAmount){
                    //commissionToPay => indicates the part of the transaction to be paid to the restaurant by PMU bank transfer
                    $commissionToPay =  $orderPickups->totalRestaurantCommission - $orderPickups->totalOrderAmount;
                }
            } else {
                //REMOVE PROMO_CODE FROM THE USER, IN THIS WAY THE USER CAN USE THE PROMO_CODE IN THE NEXT ORDER
                if(isset($cancelledTicket->promo_serial_used_id)){
                    $promoSerialUsed = PromoSerialUsed::find($cancelledTicket->promo_serial_used_id);
                    $promoSerialUsed->used = 0;
                    $promoSerialUsed->save();
                }
            }

            $paymentMethodType = 'CREDIT_CARD';
            $paymentIntentId = $cancelledTicket->order->payment->stripe_payment_intent_id;

            $order = Order::find($cancelledTicket->order_id);
            $payment = Payment::find($order->payment_id);

            $orderStatus = $order->status;
            $paymentStatus = $payment->status;

            if( $orderPickups->totalOrderAmount > 0.0 ) {
                $paymentResult = $this->stripe->updatePayment( $paymentIntentId, $orderPickups, $commissionToPay );
                if( $paymentResult == 'error' ){
                    $paymentStatus = 'ERROR';
                    $orderStatus = 'REJECTED';
                }
            } else if ( $isPromoCodeApplicable && $orderPickups->totalOrderAmount < $orderPickups->totalRestaurantCommission ) {
                $paymentMethodType = 'PROMO_CODE';
                //$paymentResult = $this->cancelPayment( $paymentIntentId );
            }

            //Save Orders
            $order->total_amount = $orderPickups->totalOrderAmount;
            $order->subtotal_amount = $orderPickups->subTotalOrderAmount;
            $order->total_commission = $orderPickups->totalPmuFeeAmount / 100;
            $order->commission_to_pay = $commissionToPay;
            $order->status = $orderStatus;
            $order->save();

            //Save Payments
            $payment->payment_method_types = $paymentMethodType;
            $payment->status = $paymentStatus;
            $payment->save();

            //Remove OrderProducts
            if( $paymentStatus != 'ERROR'){
                OrderProduct::where('order_id', $cancelledTicket->order_id)
                    ->where('pickup_id', $cancelledTicket->pickup_id)
                    ->delete();
            }

            $cancelledTicket->promo_code = null;
            $cancelledTicket->promo_serial_used_id = null;
            $cancelledTicket->save();
            DB::commit();
        } catch (\Throwable $exception){
            Log::info('An error occurred during update the Orders {' . $exception . '}');
            DB::rollback();
            DB::beginTransaction();
            $order = Order::find($cancelledTicket->order_id);
            $payment = Payment::find($order->payment_id);
            $order->status = 'ERROR';
            $order->save();
            $payment->status = 'ERROR';
            $payment->save();
            $cancelledTicket->restaurant_status = 'ACCEPTED';
            $cancelledTicket->restaurant_notes = null;
            $cancelledTicket->save();
            DB::commit();
        }

    }

    private function cancelPayment($orderId){
        Log::info("======== Here =======". $orderId);
        $countCanceledTickets = OrderPickup::where('order_id', $orderId)->where('restaurant_status', 'CANCELED')->count();
        $countAllTickets = OrderPickup::where('order_id', $orderId)->count();
        $orderDetail = Order::where('id', $orderId)->first();
        $payment = $orderDetail->payment;
        Log::info("======== countCanceledTickets =======". $countCanceledTickets);
        Log::info("======== countAllTickets =======". $countAllTickets);
        if ($countAllTickets == $countCanceledTickets) {
            if( $payment->payment_method_types == 'CREDIT_CARD' && $payment->status !== 'DONE' ){
                Log::info("-----START CANCEL PAYMENT");
                $status = $this->stripe->cancelPayment($payment->stripe_payment_intent_id);
                $this->cancelPaymentResponse($status, $payment, $orderDetail);
                Log::info("END CANCELING PAYMENT-----");
            } else if( $payment->payment_method_types == 'PROMO_CODE' && isset($payment->stripe_payment_intent_id)){
                Log::info("========> ".$payment->payment_method_types);
                $status = $this->stripe->cancelPayment($payment->stripe_payment_intent_id);
                $this->cancelPaymentResponse($status, $payment, $orderDetail);
            }
            else {
                $this->saveStatus($payment, $orderDetail, 'CANCELED', 'CANCELED');
                return response()->json(['success' => 'Ticket and order canceled successfully'], 200);
            }
        return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    private function saveStatus($payment, $order, $paymentStatus, $orderStatus){
        DB::beginTransaction();
        $payment->update(['status' => $paymentStatus]);
        $payment->update(['updated_at' => Carbon::now()]);
        $order->update(['status' => $orderStatus]);
        $order->update(['updated_at' => Carbon::now()]);
        DB::commit();
    }

    private function cancelPaymentResponse($orderStatus, $payment, $orderDetail){
        if($orderStatus == 'canceled'){
            $this->saveStatus($payment, $orderDetail, 'CANCELED', 'CANCELED');
            return response()->json(['success' => 'Ticket and order canceled successfully'], 200);
        } else {
            Log::error("An error occurred during canceling payment".$orderStatus->errors);
            $this->saveStatus($payment, $orderDetail, 'ERROR', 'REJECTED');
            return response()->json(['error' => 'An error occurred during canceling payment'], 400);
        }
    }
}
