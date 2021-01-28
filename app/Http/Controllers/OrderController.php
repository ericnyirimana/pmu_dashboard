<?php

namespace App\Http\Controllers;

use App\Traits\TranslationTrait;
use Illuminate\Http\Request;
use App\Models\OrderPickup;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use App\Libraries\StripeIntegration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Restaurant;
use App\Models\Company;
use Auth;
class OrderController extends Controller
{

    use TranslationTrait;
    
    private $stripe;
    public function __construct(StripeIntegration $stripe)
    {
        $this->stripe = $stripe;
    }

    public function index() {

        $orderPickup = new OrderPickup;
        
        if(Auth::user()->is_super){
            $orders = Order::where('created_at', '>=', Carbon::today())->orderBy('created_at', 'DESC')->get();
            return view('admin.orders.index')->with([
                    'order'  => $orders,
                    'orderPickup' => $orderPickup,
                ]
            );
        }

        $orders = Order::leftJoin('order_pickups', function ($join)  {
            $join->on('order_pickups.order_id', '=', 'orders.id');
        })
            ->where(function ($q) {
                $q->where('orders.created_at', '>=', Carbon::today());
                $q->where('orders.status', '<>', 'ERROR');
                $q->where('orders.status', '<>', 'PENDING');
                $q->where('orders.status', '<>', 'REJECTED');
            })
            ->whereIn('order_pickups.restaurant_id', Auth::user()->restaurant->pluck('id')->toArray())
            ->select('orders.*')
            ->orderBy('orders.created_at', 'DESC')
            ->get();
            return view('admin.orders.index')->with([
                'order'  => $orders,
                'orderPickup' => $orderPickup,
            ]);

    }

    public function filtering(Request $request) {

        $fields = $request->all();
        $restaurant = null;
        $brand = null;
        $orderPickup = new OrderPickup;
        if (isset($fields['date']) && !isset($fields['restaurant_id'])) {

            $dates = explode('|', $fields['date']);
            $fields['date_ini'] = Carbon::parse($dates[0]);
            $fields['date_end'] = Carbon::parse($dates[1]);
            $last_date = explode(' ', $fields['date_end']);
            $date_end = $last_date[0].' 23:59:59';
            $getOrders = Order::whereBetween('created_at', [$fields['date_ini'], $date_end])->orderBy('created_at', 'DESC')->get();
        }
        elseif (!isset($fields['date']) && isset($fields['restaurant_id'])) {

            $restaurant = Restaurant::where('id', $fields['restaurant_id'])->get();
            if(Auth::user()->is_super){
                $brand = Company::where('id', $fields['brand_id'])->get();
                $getOrders = Order::join('order_pickups', function ($join) use ($fields) {
                    $join->on('order_pickups.order_id', '=', 'orders.id')
                            ->where('order_pickups.restaurant_id', '=', $fields['restaurant_id']);
                        })
                            ->groupBy('orders.id')
                            ->orderBy('orders.created_at', 'desc')
                            ->select('orders.*')
                            ->get();
            } else {
            $getOrders = Order::join('order_pickups', function ($join) use ($fields) {
                $join->on('order_pickups.order_id', '=', 'orders.id')
                        ->where('order_pickups.restaurant_id', '=', $fields['restaurant_id'])
                        ->where('orders.status', '<>', 'ERROR')
                        ->where('orders.status', '<>', 'PENDING')
                        ->where('orders.status', '<>', 'REJECTED');
                    })
                        ->groupBy('orders.id')
                        ->orderBy('orders.created_at', 'desc')
                        ->select('orders.*')
                        ->get();
                }
        }
        elseif (isset($fields['date']) && isset($fields['restaurant_id'])) {

            $dates = explode('|', $fields['date']);
            $fields['date_ini'] = Carbon::parse($dates[0]);
            $fields['date_end'] = Carbon::parse($dates[1]);
            $last_date = explode(' ', $fields['date_end']);
            $date_end = $last_date[0].' 23:59:59';
            $restaurant = Restaurant::where('id', $fields['restaurant_id'])->get();
            if(Auth::user()->is_super){
                $brand = Company::where('id', $fields['brand_id'])->get();
                $getOrders = Order::join('order_pickups', function ($join) use ($fields) {
                    $join->on('order_pickups.order_id', '=', 'orders.id')
                            ->where('order_pickups.restaurant_id', '=', $fields['restaurant_id']);
                        })
                            ->whereBetween('orders.created_at', [$fields['date_ini'], $date_end])
                            ->groupBy('orders.id')
                            ->orderBy('orders.created_at', 'DESC')
                            ->select('orders.*')
                            ->get();
            } else {
            $getOrders = Order::join('order_pickups', function ($join) use ($fields) {
                $join->on('order_pickups.order_id', '=', 'orders.id')
                        ->where('order_pickups.restaurant_id', '=', $fields['restaurant_id'])
                        ->where('orders.status', '<>', 'ERROR')
                        ->where('orders.status', '<>', 'REJECTED')
                        ->where('orders.status', '<>', 'PENDING');
                    })
                        ->whereBetween('orders.created_at', [$fields['date_ini'], $date_end])
                        ->groupBy('orders.id')
                        ->orderBy('orders.created_at', 'DESC')
                        ->select('orders.*')
                        ->get();
                }
        }
        else{
        $getOrders = Order::where('created_at', '>=', Carbon::today())->orderBy('created_at', 'DESC')->get();;
        }

        if(Auth::user()->is_super){
            return view('admin.orders.index')->with([
                    'order'  => $getOrders,
                    'restaurant'  => $restaurant,
                    'orderPickup' => $orderPickup,
                    'brand'  => $brand,
                    'dates'  => $fields['date'],
                ]
            );
        }
        return view('admin.orders.index')->with([
            'order'  => $getOrders,
            'restaurant'  => $restaurant,
            'orderPickup' => $orderPickup,
            'dates'  => $fields['date'],
        ]);
    }

    public function show(Order $order, Product $products) {

        if(Auth::user()->is_restaurant || Auth::user()->is_owner){
            $ordersPickup = OrderPickup::where('order_id', $order->id)->whereIn('restaurant_id', Auth::user()->restaurant->pluck('id')->toArray())
                ->count();
            if($ordersPickup == 0) {
                return view('errors.403');
            }
        }
        $tickets = $order->orderPickups;
        $restaurant = $order->orderPickups->first()->restaurant;
        $closedTicket = $order->orderPickups->where('closed', 1)->count();
        $user = User::where('id', $order->user_id)->first();
        return view('admin.orders.view')->with([
                'order'  => $order,
                'ordersTickets'  => $tickets,
                'products'  => $products,
                'user'  => $user,
                'restaurant' => $restaurant,
                'closedTickets' => $closedTicket,
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
            $orderPickup->update(['closed' => 1]);
            $orderDetail = Order::where('id', $request->all()['id'])->first();
            //Check if all tickets are closed to capture the Stripe payments
            $payment = $orderDetail->payment;
            if ($payment->payment_method_types !== 'PROMO_CODE' && $payment->status == 'PENDING') {
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
    catch (\Throwable $exception) {
        Log::info('An error occurred during capture payment {' . $exception . '}');
        DB::rollback();
    }
    }

}