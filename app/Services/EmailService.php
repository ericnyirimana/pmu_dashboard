<?php

namespace App\Services;

use App\Models\User;
use Aws\Ses\SesClient;
use Illuminate\Support\Facades\Log;

class EmailService {

    public function __construct(){
    }

    /**
     * @param $userFirstName
     * @param $userEmail
     * @param $userId
     * @param $ticket
     */
    public function sendEmailCancelOrder($userFirstName, $userEmail, $userId, $ticket){
        Log::info("Send ticket cancelled (ticket_id:". $ticket->id .") to User ID: " . $userId );

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

        $json = array( "username" => $userFirstName,
            "restaurant_name"=> $ticket->restaurant->name,
            "restaurant_notes"=> $ticket->restaurant_notes,
            "order_id" => $ticket->id,
        );
        try {

            $result = $sesClient->sendTemplatedEmail([
                'Destination' => [
                    'ToAddresses' => [$userEmail],
                ],
                'ReplyToAddresses' => [$sender_email],
                'Source' => $sender_email,

                'Template' => $template_name,
                'TemplateData' => json_encode($json),
            ]);
            $result = $sesClient->sendTemplatedEmail([
                'Destination' => [
                    'ToAddresses' => [env('SENDER_CANCELLED_EMAIL')],
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
