<?php

namespace App\Services;

use App\Models\User;
use Aws\Ses\SesClient;
use Illuminate\Support\Facades\Log;

class EmailService {

    public function __construct(){
    }

    public function sendEmailCancelOrder($ticket){
        Log::info("Send order cancelled to User ID: " . $ticket->order->user_id );

        $user = User::find($ticket->order->user_id);

        $sesClient = new SesClient([
            'version' => env('AWS_COGNITO_VERSION'),
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
        $template_name = 'CancelOrderTemplate';
        $sender_email = env('SENDER_EMAIL');

        $json = array( "username" => $user->first_name,
            "restaurant_name"=> $ticket->restaurant_name,
            "restaurant_notes"=> $ticket->restaurant_notes,
            "order_id" => $ticket->id,
        );
        try {

            $result = $sesClient->sendTemplatedEmail([
                'Destination' => [
                    'ToAddresses' => [$user->email],
                    'BccAddresses'=> [env('SENDER_CANCELLED_EMAIL')],
                ],
                'ReplyToAddresses' => [$sender_email],
                'Source' => $sender_email,

                'Template' => $template_name,
                'TemplateData' => json_encode($json),
            ]);
            Log::debug("Email message Id: " . $result->get('MessageId') );
        } catch (\Throwable $exception) {
            Log::error('An error has occurred during send the email {' . $exception->getMessage() . '}');
        }
    }
}
