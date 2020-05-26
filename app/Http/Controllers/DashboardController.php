<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Dashboard;
use App\Models\OrderPickup;
use App\Models\Pickup;

use Auth;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{

    public function __construct()
    {

        $this->authorizeResource(Dashboard::class);

    }

    public function login() {

        return view('auth.login');

    }

    public function index() {

        $companies = new Collection();
        $pickups = new Collection();
        $ordersPickup = new Collection();

        if (Auth::user()->is_manager) {

            $restaurantsID = Auth::user()->restaurant->pluck('id');

            $pickups = Pickup::whereIn('restaurant_id', $restaurantsID)
                ->limit(4)
                ->get();

            $ordersPickup = OrderPickup::with(['pickup'])
                ->whereHas('pickup', function ($q) use ($restaurantsID) {
                    $q->whereIn('restaurant_id', $restaurantsID);
                })
                ->limit(4)
                ->get();

        } else {
            $companies = Company::limit(3)->get();
            $pickups = Pickup::limit(4)->get();
            $ordersPickup = OrderPickup::limit(4)->get();
        }


        return view('admin.index')
            ->with(compact('companies'))
            ->with(compact('pickups'))
            ->with(compact('ordersPickup'));

    }

    public function blank() {

        return view('admin.blank');

    }

}
