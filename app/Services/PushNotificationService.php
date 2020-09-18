<?php


namespace App\Services;

use Aws\Pinpoint\PinpointClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PushNotificationService{

    public function __construct(){}

    public function sendPushNotification($usersSub, $title, $body){
        Log::info('Send PushNotification to ( users: {' . implode(',', $usersSub) . '})');
        $pinpointClient = new PinpointClient([
            'version' => env('AWS_COGNITO_VERSION'),
            'region' => env('AWS_PINPOINT_VERSION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        //TODO: CHANGE PUSHER_PN_INSTANCE_ID IN PINPOINT_APPLICATION_ID
        foreach( $usersSub as $sub ){
            try{
                $userEndpoints = $pinpointClient->getUserEndpoints([
                    'ApplicationId' => env('PUSHER_PN_INSTANCE_ID'), // REQUIRED
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
                        "body"  => $body
                    )
                );

                $traceId = (string)Str::uuid();
                $result = $pinpointClient->sendMessages([
                    'ApplicationId' => env('PUSHER_PN_INSTANCE_ID'), // REQUIRED
                    'MessageRequest' => [ // REQUIRED
                        'MessageConfiguration' => [ // REQUIRED
                            'APNSMessage' => [
                                'APNSPushType' => 'alert',
                                'Action' => 'OPEN_APP',
                                'Sound' => 'default',
                                'Body' => $body,
                                'Priority' => 'high',
                                'SilentPush' => false,
                                'TimeToLive' => 30,
                                'Title' => $title,
                            ],
                            'GCMMessage' => [
                                'Action' => 'OPEN_APP',
                                'Body' => $body,
                                'Priority' => 'high',
                                'RawContent' => json_encode($gcmMessageRawContent),
                                'SilentPush' => false,
                                'TimeToLive' => 30,
                                'Title' => $title,
                            ],
                        ],
                        'TraceId' => $traceId,
                        'Endpoints' => $pinpointEndpoints,
                    ],
                ]);
                Log::info('PushNotification is sent with TraceID {'.$traceId.'}, result: '. $result->get('MessageResponse'));
            }catch (\Throwable $e){
                Log::warning('An error has occurred during send PushNotification : {' . $e->getMessage() . '})');
            }

        }

    }

    public function updateUserEndpoint(){
        $pinpointClient = new PinpointClient([
            'version' => env('AWS_COGNITO_VERSION'),
            'region' => env('AWS_PINPOINT_VERSION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $result = $pinpointClient->getUserEndpoint([
            'ApplicationId' => env('PUSHER_PN_INSTANCE_ID'), // REQUIRED
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
        $pinpointClient = new PinpointClient([
            'version' => env('AWS_COGNITO_VERSION'),
            'region' => env('AWS_PINPOINT_VERSION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $result = $pinpointClient->deleteEndpoint([
            'ApplicationId' => env('PUSHER_PN_INSTANCE_ID'), // REQUIRED
            'EndpointId' => $endpoint, // REQUIRED
        ]);

    }

    public function getUserEndpoints($sub){
        $pinpointClient = new PinpointClient([
            'version' => env('AWS_COGNITO_VERSION'),
            'region' => env('AWS_PINPOINT_VERSION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            $userEndpoints = $pinpointClient->getUserEndpoints([
                'ApplicationId' => env('PUSHER_PN_INSTANCE_ID'), // REQUIRED
                'UserId' => $sub //REQUIRED
            ]);
            return $userEndpoints;
        } catch (\Throwable $e){
            Log::warning('Endpoint not exist for the user : {' . $sub . '})');
        }




    }

}
