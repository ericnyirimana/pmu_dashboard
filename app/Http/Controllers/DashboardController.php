<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Dashboard;
use App\Models\OrderPickup;
use App\Models\Pickup;

use App\Models\SubscriptionTicket;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{

    public function __construct()
    {

        $this->authorizeResource(Dashboard::class);

    }

    public function login()
    {

        return view('auth.login');

    }

    public function index(Request $request)
    {

        $companies = new Collection();
        $pickups = new Collection();
        $ordersPickup = new Collection();

        if (Auth::user()->is_manager) {

            if (Auth::user()->is_owner && isset($request->restaurant_id) && !empty($request->restaurant_id)) {
                if (Auth::user()->restaurant->pluck('id')->contains($request->restaurant_id)) {
                    $restaurantsID[] = $request->restaurant_id;
                } else {
                    $restaurantsID = [];
                }

            } else {
                $restaurantsID = Auth::user()->restaurant->pluck('id');
            }


            $pickups = Pickup::whereIn('restaurant_id', $restaurantsID)
                ->limit(4)
                ->get();

            $ordersPickup = OrderPickup::with(['pickup'])
                ->whereHas('pickup', function ($q) use ($restaurantsID) {
                    $q->whereIn('restaurant_id', $restaurantsID);
                })
                ->limit(4)
                ->get();

            $isComingTickets = OrderPickup::with(['pickup'])
                ->whereHas('pickup', function ($q) use ($restaurantsID) {
                    $q->whereIn('restaurant_id', $restaurantsID);
                })
                ->where([
                    ['date', '>=', Carbon::today()],
                    ['is_coming', 1],
                    ['closed', 0]
                ])
                ->get();

            $isComingTicketsSubscription = SubscriptionTicket::with(['pickup'])
                ->whereHas('pickup', function ($q) use ($restaurantsID) {
                    $q->whereIn('restaurant_id', $restaurantsID);
                })
                ->where([
                    ['created_at', '>=', Carbon::today()],
                    ['is_coming', 1],
                    ['closed', 0]
                ])
                ->get();

        } else {
            $companies = Company::limit(3)->get();
            $pickups = Pickup::limit(4)->get();
            $ordersPickup = OrderPickup::limit(4)->get();
            $isComingTickets = OrderPickup::where([
                    ['is_coming', 1],
                    ['closed', 0]
                ])
                ->get();
            $isComingTicketsSubscription = SubscriptionTicket::where([
                ['is_coming', 1],
                ['closed', 0]
            ])
                ->get();
        }

        $isComing = $isComingTickets->merge($isComingTicketsSubscription);
        $isComing = $isComing->sortBy('updated_at')->slice(0, 4);
        return view('admin.index')
            ->with(compact('companies'))
            ->with(compact('pickups'))
            ->with(compact('ordersPickup'))
            ->with(compact('isComing'));

    }

    public function blank()
    {

        return view('admin.blank');

    }

}
