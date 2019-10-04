<?php

namespace App\Providers;

use App\Providers\JobWasAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  JobWasAccepted  $event
     * @return void
     */
    public function handle(JobWasAccepted $event)
    {
        //
    }
}
