<?php

namespace App\Http\Controllers;

use App\Models\PickupSubscription;
use Illuminate\Http\Request;

class PickupSubscriptionController extends Controller
{

    public function show(Request $request)
    {

        $pickupSubscription = PickupSubscription::find($request->id);

        return view('admin.subscriptions.view')->with([
                'pickupSubscription'  => $pickupSubscription
            ]
        );
    }

}
