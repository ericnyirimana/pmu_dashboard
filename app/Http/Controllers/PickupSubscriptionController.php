<?php

namespace App\Http\Controllers;

use App\Models\PickupSubscription;

class PickupSubscriptionController extends Controller
{

    public function show(PickupSubscription $pickupSubscription)
    {

        return view('admin.subscriptions.view')->with([
                'pickupSubscription'  => $pickupSubscription
            ]
        );
    }

}
