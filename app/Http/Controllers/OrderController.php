<?php

namespace App\Http\Controllers;

use App\Traits\TranslationTrait;
use Illuminate\Http\Request;
use App\Models\OrderPickup;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Libraries\StripeIntegration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    use TranslationTrait;
    
    private $stripe;
    public function __construct(StripeIntegration $stripe)
    {
        $this->stripe = $stripe;
    }

    public function index() {
        $orders = Order::where('created_at', '>=', Carbon::today())->orderBy('created_at', 'DESC')->get();
        return view('admin.orders.index')->with([
                'order'  => $orders,
            ]
        );

    }

    public function filtering(Request $request, Order $order) {

        $fields = $request->all();
        if (isset($fields['date']) && !isset($fields['restaurant_id'])) {

            $dates = explode('|', $fields['date']);
            $fields['date_ini'] = Carbon::parse($dates[0]);
            $fields['date_end'] = Carbon::parse($dates[1]);
            $getOrders = $order->whereBetween('created_at', [$fields['date_ini'], $fields['date_end']])->get();

        }
        elseif (!isset($fields['date']) && isset($fields['restaurant_id'])) {

            $getOrders = new Collection();
            $i = -1;
                foreach ($order as $all_orders) {
                    $i++;
                    $get_restaurant = Order::all()[$i]->orderPickups[0]->pickup->restaurant_id;
                    if ($get_restaurant == $fields['restaurant_id']) {
                        $getOrders->push(Order::all()[$i]);
                    }
                }
        }
        elseif (isset($fields['date']) && isset($fields['restaurant_id'])) {

            $dates = explode('|', $fields['date']);
            $fields['date_ini'] = Carbon::parse($dates[0]);
            $fields['date_end'] = Carbon::parse($dates[1]);
            $getOrders = new Collection();
            $i = -1;
                foreach ($order as $all_orders) {
                    $i++;
                    $get_restaurant = Order::whereBetween('created_at', [$fields['date_ini'], $fields['date_end']])->get()[$i]->orderPickups[0]->pickup->restaurant_id;
                    if ($get_restaurant == $fields['restaurant_id']) {
                        $getOrders->push(Order::whereBetween('created_at', [$fields['date_ini'], $fields['date_end']])->get()[$i]);
                    }
                }
        }
        else{
        $getOrders = $order->where('created_at', '>=', Carbon::today())->orderBy('created_at', 'DESC')->get();;
        }
        return view('admin.orders.index')->with([
                'order'  => $getOrders,
            ]
        );

    }

    public function show(Order $order, Product $products) {

        $tickets = $order->orderPickups;
        return view('admin.orders.view')->with([
                'order'  => $order,
                'ordersTickets'  => $tickets,
                'products'  => $products,
            ]
        );

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function closeOrder(Request $request)
    {
        try{
        $orderPickup = OrderPickup::where('order_id', $request->all()['id'])->where('closed', 0);
        // if (Auth::user()->is_super) {
            $orderPickup->update(['closed' => 1]);
            $orderDetail = Order::where('id', $request->all()['id'])->first();
            //Check if all tickets are closed to capture the Stripe payments
            $payment = $orderDetail->payment;
                if( $payment->payment_method_types == 'CREDIT_CARD' && $payment->status == 'PENDING' ){
                    Log::info("-----START CAPTURE PAYMENT");
                    $status = $this->stripe->capturePayment($payment->stripe_payment_intent_id);
                    DB::beginTransaction();
                    if($status == 'succeeded'){
                        $payment->update(['status' => 'DONE']);
                        $orderDetail->update(['status' => 'PAID']);
                    } else {
                        Log::error("An error occurred during capture payment".$status->errors);
                        return response()->json(['error' => 'An error occurred during capture payment'], 400);
                    }
                    DB::commit();
                    Log::info("END CAPTURE PAYMENT-----");
                    return response()->json(['success' => 'Payment done successfully'], 200);
                }
            return response()->json(['error' => 'Something went wrong'], 500);
        // }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    catch (\Throwable $exception) {
        Log::info('An error occurred during capture payment {' . $exception . '}');
        DB::rollback();
    }
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelOrder(Request $request)
    {
        try{
        $orderPickup = OrderPickup::where('order_id', $request->all()['id'])->where('closed', 0);
        if (Auth::user()->is_super) {
            $orderPickup->update(['closed' => 1]);
            $orderDetail = Order::where('id', $request->all()['id'])->first();
            //Check if all tickets are closed to capture the Stripe payments
            $payment = $orderDetail->payment;
                if( $payment->payment_method_types == 'CREDIT_CARD' && $payment->status !== 'DONE' ){
                    Log::info("-----START CANCEL PAYMENT");
                    $status = $this->stripe->cancelPayment($payment->stripe_payment_intent_id);
                    DB::beginTransaction();
                    if($status == 'succeeded'){
                        $payment->update(['status' => 'CANCELED']);
                        $orderDetail->update(['status' => 'CANCELED']);
                    } else {
                        Log::error("An error occurred during capture payment".$status->errors);
                        return response()->json(['error' => 'An error occurred during capture payment'], 400);
                    }
                    DB::commit();
                    Log::info("END CAPTURE PAYMENT-----");
                    return response()->json(['success' => 'Payment done successfully'], 200);
                }
            return response()->json(['error' => 'Something went wrong'], 500);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    catch (\Throwable $exception) {
        Log::info('An error occurred during capture payment {' . $exception . '}');
        DB::rollback();
    }
    }
}