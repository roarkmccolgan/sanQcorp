<?php

namespace App\Providers;

use App\Providers\JobWasUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateOpportunityOnInsightly
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
     * @param  JobWasUpdated  $event
     * @return void
     */
    public function handle(JobWasUpdated $event)
    {
        //
    }
}
