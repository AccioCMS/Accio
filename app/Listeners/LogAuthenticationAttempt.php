<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Event;

class LogAuthenticationAttempt
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // DO NOT DELETE THIS. IT MAY BE USED BY A PLUGIN!
        Event::fire('auth.authentication_attempt', [$event]);
    }
}
