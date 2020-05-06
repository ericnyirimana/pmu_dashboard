<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

        ];

        $request->validate(
            $validation
        );

    }

    public function index()
    {

        $order = Order::all();

        return view('admin.orders.index')
            ->with(compact('order'));

    }

    public function show(Order $order) {

        return view('admin.orders.view')->with([
                'order'  => $order
            ]
        );

    }

    public function update(Request $request, Order $order) {

        $this->validation($request, $order);

        $fields = $request->all();

        $order->update($fields);

        return redirect()->route('orders.index')->with([
            'notification' => trans('messages.notification.order_confirmed'),
            'type-notification' => 'success'
        ]);

    }
    
}
