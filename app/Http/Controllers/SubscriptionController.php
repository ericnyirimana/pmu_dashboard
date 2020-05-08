<?php

namespace App\Http\Controllers;


use App\Models\PickupSubscription;
use App\Traits\TranslationTrait;

class SubscriptionController extends Controller
{

    use TranslationTrait;

    public function index()
    {

        $subscriptions = PickupSubscription::all();

        return view('admin.subscriptions.view')
            ->with(compact('subscriptions'));

    }

    public function show(PickupSubscription $subscriptions) {


        return view('admin.subscriptions.view')->with([
                'pickupSubscription'  => $subscriptions,
            ]
        );

    }

    public function update(PickupSubscription $subscriptions) {

        return redirect()->route('restaurants.edit', $subscriptions)->with([
            'notification' => trans('messages.notification.order_confirmed'),
            'type-notification' => 'success'
        ]);

    }

}
