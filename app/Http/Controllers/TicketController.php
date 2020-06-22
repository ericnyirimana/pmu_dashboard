<?php

namespace App\Http\Controllers;

use App\Libraries\Pusher;
use App\Models\OrderPickup;
use App\Models\SubscriptionTicket;
use App\Services\EmailService;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    protected $pusher;
    protected $emailService;

    public function __construct(Pusher $pusher, EmailService $emailService)
    {
        $this->pusher = $pusher;
        $this->emailService = $emailService;
    }

    public function validation(Request $request, $company = null)
    {

        $request->validate(
            [
                'restaurant_notes' => 'required',
            ]
        );

    }

    public function show(Request $request) {

        if (strpos($request->ticket, 'SUB') !== false) {
            //Take ticket subscription
            $ticket = SubscriptionTicket::find(str_replace('SUB', '', $request->ticket));
        } else {
            //Take ticket offer
            $ticket = OrderPickup::find($request->ticket);
        }

        if ($ticket) {
            return view('admin.tickets.view')->with([
                    'ticket'  => $ticket,
                ]
            );
        }

        abort(404);

    }

    public function update(Request $request, $ticketId) {

        if (strpos($ticketId, 'SUB') !== false) {
            //Take ticket subscription
            $ticket = SubscriptionTicket::find(str_replace('SUB', '', $ticketId));
        } else {
            //Take ticket offer
            $ticket = OrderPickup::find($request->ticket);
        }

        $this->validation($request, $ticket);

        $fields = $request->all();
        if ($ticket) {
            $ticket->restaurant_notes = $fields['restaurant_notes'];
            $ticket->restaurant_status = $fields['restaurant_status'];
            $ticket->save();

            // Notify user with PN
            /*
            $this->pusher->sendPushNotification(
                [strval($ticket->order->user_id)],
                trans('push-notifications.ticket_reject.title'),
                trans('push-notifications.ticket_reject.message', ['ticketId' => $ticketId, 'notes' => $ticket->restaurant_notes])
                );
            */
            // Send cancel order email
            $this->emailService->sendEmailCancelOrder($ticket);

            return redirect()->route('ticket.show', $ticket)->with([
                'notification' => trans('messages.notification.tickets_saved'),
                'type-notification' => 'success'
            ]);
        }
        abort(400);

    }
}
