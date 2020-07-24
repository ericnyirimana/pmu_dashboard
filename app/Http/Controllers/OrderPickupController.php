<?php

namespace App\Http\Controllers;

use App\Models\OrderPickup;
use App\Traits\TranslationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        return redirect()->route('restaurants.edit', $ordersPickup->pickup->restaurant)->with([
            'notification' => trans('messages.notification.order_confirmed'),
            'type-notification' => 'success'
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function closeTicket(Request $request)
    {
        try{
        $orderTicket = OrderPickup::where('id', $request->id)->first();
        if (Auth::user()->is_super) {
            if ($orderTicket) {
                $orderTicket->update(['closed' => 1]);
                return response()->json(['success' => 'Ticket successfully closed'], 200);
            }
            return response()->json(['error' => 'Ticket not found'], 404);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
        }
        catch (\Throwable $exception) {
            Log::info('An error occurred during closing Ticket {' . $exception . '}');
            return response()->json(['error' => 'An error occurred during closing Ticket'], 500);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function countUnCanceledTicket(Request $request)
    {
        $countCanceledTickets = OrderPickup::where('order_id', $request->order)->where('restaurant_status', 'CANCELED')->count();
        $countAllTickets = OrderPickup::where('order_id', $request->order)->count();
        if ($countAllTickets == $countCanceledTickets) {
            return response()->json(['success' => 'All tickets are canceled'], 200);
        }
        return response()->json(['success' => 'All tickets are not canceled'], 200);
    }

}
