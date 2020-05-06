<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pickup;
use App\Traits\TranslationTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    use TranslationTrait;

    public function __construct() {

        $this->authorizeResource(Order::class);

    }

    public function validation(Request $request) {

        $validation = [
            'status'
        ];

        $request->validate(
            $validation
        );

    }

    public function index()
    {

        $order = Order::all();
        $pickup = Pickup::all();

        return view('admin.tab-orders.view')
            ->with(compact('order'))
            ->with(compact('pickup'));

    }

    public function show(Order $order, Pickup $pickup) {

        return view('admin.tab-orders.view')->with([
                'order'  => $order,
                'pickup' => $pickup
            ]
        );

    }

    public function update(Request $request, Order $order) {

        $this->validation($request, $order);

        $fields = $request->all();

        $order->update($fields);

        return redirect()->route('restaurants.edit', $order)->with([
            'notification' => trans('messages.notification.order_confirmed'),
            'type-notification' => 'success'
        ]);

    }
    
}
