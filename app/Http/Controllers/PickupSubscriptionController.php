<?php

namespace App\Http\Controllers;

use App\Models\PickupSubscription;
use App\Models\Pickup;
use App\Models\OrderPickup;
use App\Models\SubscriptionTicket;
use App\Models\Restaurant;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;

class PickupSubscriptionController extends Controller
{
    public function index() {
        try{
            $pickupSubscriptions = new PickupSubscription;
            if(Auth::user()->is_restaurant) {
                $restaurant = Auth::user()->restaurant->pluck('id')->toArray();
                $pickupsId = Pickup::whereIn('restaurant_id', $restaurant)->pluck('id');
                $pickupSubscriptions = PickupSubscription::whereIn('pickup_id', $pickupsId)->get();
            }
            return view('admin.subscriptions.index')->with([
                'pickupSubscriptions' => $pickupSubscriptions,
                'subscriptions' => new PickupSubscription,
            ]);
        } 
        catch (\Throwable $exception) {
            Log::info('An error occurred during capture payment {' . $exception . '}');
        }

    }

    public function show(Request $request)
    {

        $pickupSubscription = PickupSubscription::find($request->id);
        $menu = $pickupSubscription->pickup->sections;
        $orderPickupDetail = OrderPickup::join('user_subscriptions', 'user_subscriptions.order_pickup_id', '=', 'order_pickups.id')
        ->join('users', 'users.id', '=', 'user_subscriptions.user_id')
        ->where('order_pickups.pickup_id',$pickupSubscription->pickup_id)
        ->get(['order_pickups.*', 'users.first_name', 'users.last_name', 'user_subscriptions.quantity_subscription', 'user_subscriptions.quantity_remain']);
        return view('admin.subscriptions.view')->with([
                'pickupSubscription'  => $pickupSubscription,
                'menu' => $menu,
                'orderPickupDetail' => $orderPickupDetail,
            ]
        );
    }

    public function detail(Request $request)
    {
        $orderPickup = OrderPickup::find($request->pickup_id);
        $type_offer = $orderPickup->pickup()->first()->type_offer;
        if($type_offer == 'loyalty_card'){
            $orderTicketDetail = SubscriptionTicket::leftJoin('pickups', 'pickups.id', '=', 'subscription_tickets.pickup_id')
                ->join('pickup_products', 'pickup_products.pickup_id', '=', 'pickups.id')
                ->join('product_translations', 'product_translations.product_id', '=', 'pickup_products.product_id')
                ->where('subscription_tickets.order_pickup_id',$request->pickup_id)
                ->where('subscription_tickets.order_id',$request->order_id)
                ->where('subscription_tickets.restaurant_status','ACCEPTED')
                ->get(['subscription_tickets.id', 'subscription_tickets.date', 'subscription_tickets.created_at', 'subscription_tickets.quantity', 'subscription_tickets.closed' ,'product_translations.name']);
        }
        else{
        $orderTicketDetail =
            SubscriptionTicket::leftJoin('subscription_ticket_products', 'subscription_ticket_products.subscription_ticket_id', '=', 'subscription_tickets.id')
                ->join('product_translations', 'product_translations.product_id', '=', 'subscription_ticket_products.product_id')
                ->where('subscription_tickets.order_pickup_id',$request->pickup_id)
                ->where('subscription_tickets.order_id',$request->order_id)
                ->where('subscription_tickets.restaurant_status','ACCEPTED')
                ->get(['subscription_tickets.id', 'subscription_tickets.date', 'subscription_tickets.created_at', 'subscription_tickets.quantity', 'subscription_tickets.closed' ,'product_translations.name']);
        }
        if($orderTicketDetail->count() > 0){
            return response()->json($orderTicketDetail, 200);
        }

        return response()->json(['message' => trans('messages.notification.subscription_not_ordered')], 200);
    }

    public function filtering(Request $request) {
        try{
            $fields = $request->all();
            $pickupSubscriptions = new PickupSubscription;
            if((Auth::user()->is_owner || Auth::user()->is_super) && isset($fields['restaurant_id'])) {
                $pickupsId = Pickup::where('restaurant_id', $fields['restaurant_id'])->pluck('id');
                $pickupSubscriptions = PickupSubscription::whereIn('pickup_id', $pickupsId)->get();
            }
            else{
                $restaurant = Auth::user()->restaurant->pluck('id')->toArray();
                $pickupsId = Pickup::whereIn('restaurant_id', $restaurant)->pluck('id');
                $pickupSubscriptions = PickupSubscription::whereIn('pickup_id', $pickupsId)->get();
            }
            if(Auth::user()->is_super){
                $restaurant = Restaurant::where('id', $fields['restaurant_id'])->get();
                $brand = Company::where('id', $fields['brand_id'])->get();
                return view('admin.subscriptions.index')->with([
                    'pickupSubscriptions' => $pickupSubscriptions,
                    'restaurant' => $restaurant,
                    'brand' => $brand,
                ]);
            }
            return view('admin.subscriptions.index')->with([
                'pickupSubscriptions' => $pickupSubscriptions,
                'subscriptions' => new PickupSubscription,
            ]);
        } 
        catch (\Throwable $exception) {
            Log::info('An error occurred during capture payment {' . $exception . '}');
        }

    }

}
