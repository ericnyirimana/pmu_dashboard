<?php

namespace App\Http\Controllers;

use App\Models\OrderPickup;
use App\Traits\TranslationTrait;
use Illuminate\Http\Request;

class OrderPickupController extends Controller
{

    use TranslationTrait;

    public function show(OrderPickup $ordersPickup) {


        return view('admin.orders-pickup.view')->with([
                'ordersPickup'  => $ordersPickup,
            ]
        );

    }

    public function update(Request $request, OrderPickup $ordersPickup) {

        $fields = $request->all();
        $ordersPickup->order->status = $fields['status'];
        $ordersPickup->order->save();

        return redirect()->route('restaurants.edit', $ordersPickup)->with([
            'notification' => trans('messages.notification.order_confirmed'),
            'type-notification' => 'success'
        ]);

    }

}
