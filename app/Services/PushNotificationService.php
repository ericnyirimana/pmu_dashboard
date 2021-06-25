<?php


namespace App\Services;

use Aws\Pinpoint\PinpointClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PushNotificationService{

    protected $pinpointClient;

    public function __construct(){
        $this->pinpointClient = new PinpointClient([
            'version' => env('AWS_COGNITO_VERSION'),
            'region' => env('AWS_PINPOINT_VERSION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }

    // public function sendPushNotificationToPartner($usersSub, $title, $body){
    //     $this->sendPushNotification($usersSub, $title, $body, env('AWS_PINPOINT_ID_APP_PARTNER'), array());
    // }

    // public function sendPushNotificationToCustomer($usersSub, $title, $body, $params){

    //     $this->sendPushNotification($usersSub, $title, $body, env('AWS_PINPOINT_ID_APP_CUSTOMER'), $params);
    // }

    public function sendPnToCustomerTicketCancelled($usersSub, $title, $body, $params){

        $notification = array(
            "type" => "ticket_cancelled",
            "params" => $params
        );

        $this->sendPushNotification($usersSub, $title, $body, env('AWS_PINPOINT_ID_APP_CUSTOMER'), $notification, $params );
    }

    private function sendPushNotification($usersSub, $title, $body, $applicationId, $notification, $params){
        Log::info('Send PushNotification to ( users: {' . implode(',', $usersSub) . '})');
        foreach( $usersSub as $sub ){
            try{
                $userEndpoints = $this->pinpointClient->getUserEndpoints([
                    'ApplicationId' => $applicationId, // REQUIRED
                    'UserId' => $sub //REQUIRED
                ]);
            } catch (\Throwable $e){
                Log::warning('Endpoint not exist for the user : {' . $sub . '})');
                continue;
            }

            try{

                $pinpointEndpoints = [];
                foreach ( $userEndpoints as $userEndpoint){
                    if(isset($userEndpoint['Item'])){
                        foreach($userEndpoint['Item'] as $endpoint){
                            if( $endpoint['ChannelType'] == 'GCM' ||
                                $endpoint['ChannelType'] == 'APNS' ||
                                $endpoint['ChannelType'] == 'APNS_SANDBOX'
                            ){
                                $pinpointEndpoints[$endpoint['Id']] = array();
                            }
                        }
                    }
                }

                $gcmMessageRawContent = array(
                    "notification" => array(
                        "title" => $title,
                        "body"  => $body
                    ),
                    "data" => array(
                        "title" => $title,
                        "body"  => $body,
                        "params" => $params,
                        "notification" => $notification

                    )
                );

                $iOSMessageRawContent = array(
                    "aps" => array(
                        "alert" => array(
                            "title" => $title,
                            "body" => $body
                        ),
                        "sound" => 'default',
                        "body" => $body,
                        "params" => $params,
                        "notification" => $notification
                    ),
                );

                $traceId = (string)Str::uuid();
                $result = $this->pinpointClient->sendMessages([
                    'ApplicationId' => $applicationId, // REQUIRED
                    'MessageRequest' => [ // REQUIRED
                        'MessageConfiguration' => [ // REQUIRED
                            'APNSMessage' => [
                                'APNSPushType' => 'alert',
                                'Action' => 'OPEN_APP',
                                'Sound' => 'default',
                                'Body' => $body,
                                'RawContent' => json_encode($iOSMessageRawContent, JSON_FORCE_OBJECT),
                                'Priority' => 'high',
                                'SilentPush' => false,
                                'TimeToLive' => 30,
                                'Title' => $title,
                            ],
                            'GCMMessage' => [
                                'Action' => 'OPEN_APP',
                                'Body' => $body,
                                'Priority' => 'high',
                                'RawContent' => json_encode($gcmMessageRawContent, JSON_FORCE_OBJECT),
                                'SilentPush' => false,
                                'TimeToLive' => 30,
                                'Title' => $title,
                            ],
                        ],
                        'TraceId' => $traceId,
                        'Endpoints' => $pinpointEndpoints,
                    ],
                ]);

                /*
                $pinpointEndpoints = $result->get('MessageResponse')['EndpointResult'];
                foreach ($pinpointEndpoints as $pinpointEndpointResponse){
                    Log::info('PushNotification is sent with TraceID {'.$traceId.'}, to this address: '. $pinpointEndpointResponse['Address']);
                    Log::info('----- DeliveryStatus: '. $pinpointEndpointResponse['DeliveryStatus']);
                    Log::info('----- StatusMessage: '. $pinpointEndpointResponse['StatusMessage']);
                }
                */
            }catch (\Throwable $e){
                Log::warning('An error has occurred during send PushNotification : {' . $e->getMessage() . '})');
            }

        }

    }

    public function updateUserEndpoint(){
        $result = $this->pinpointClient->getUserEndpoint([
            'ApplicationId' => env('AWS_PINPOINT_ID_APP_PARTNER'), // REQUIRED
            'EndpointId' => 'f4e3dd8a-2ae3-4602-abcf-a77f69f2aafd', // REQUIRED
        ]);
/*
        $result = $pinpointClient->updateUserEndpoint([
                    'ApplicationId' => env('PUSHER_PN_INSTANCE_ID'), // REQUIRED
                    'EndpointId' => '123-test-marco', // REQUIRED
                    'EndpointRequest' => [ // REQUIRED
                            'Address' => 'FCMToken',
                            'ChannelType' => 'GCM',
                            'User' => [
                                'UserAttributes' => [
                                    '<__string>' => ['<string>', ...],
                                    // ...
                                ],
                                'UserId' => '10c79cf8-44d7-4a9e-8e1c-fb589229bf44',
                            ],
                        ],
                    ]);
*/
        $a = json_encode($result, JSON_PRETTY_PRINT);
        Log::info($a);
    }

    public function deleteEndpoint($endpoint){
        $result = $this->pinpointClient->deleteEndpoint([
            'ApplicationId' => env('AWS_PINPOINT_ID_APP_PARTNER'), // REQUIRED
            'EndpointId' => $endpoint, // REQUIRED
        ]);

    }

    public function getUserEndpoints($sub){
        try {
            $userEndpoints = $this->pinpointClient->getUserEndpoints([
                'ApplicationId' => env('AWS_PINPOINT_ID_APP_PARTNER'), // REQUIRED
                'UserId' => $sub //REQUIRED
            ]);
            return $userEndpoints;
        } catch (\Throwable $e){
            Log::warning('Endpoint not exist for the user : {' . $sub . '})');
        }




    }

}
