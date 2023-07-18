<?php

namespace App\Providers;

class SendAcceptedNotifications
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
     * @return void
     */
    public function handle(JobWasAccepted $event)
    {
        //
    }
}
