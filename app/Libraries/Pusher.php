<?php


namespace App\Libraries;

use Illuminate\Support\Facades\Log;

class Pusher
{
    protected $beamsClient;

    public function __construct()
    {
        $this->beamsClient = new \Pusher\PushNotifications\PushNotifications([
            'instanceId' => env('PUSHER_PN_INSTANCE_ID'),
            'secretKey' => env('PUSHER_PN_SECRET_KEY'),
        ]);
    }

    public function generateBeamsToken($user) {
        try {
            return $this->beamsClient->generateToken((string)$user->id);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            throw new \Exception($exception);
        }

    }
}
