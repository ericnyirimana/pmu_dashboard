<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if (!isset($event->user->previous_login)){
            $event->user->previous_login = date('Y-m-d H:i:s');
        } else {
            $event->user->previous_login = $event->user->last_login;
        }
        $event->user->last_login = date('Y-m-d H:i:s');
        $event->user->save();
    }
}
