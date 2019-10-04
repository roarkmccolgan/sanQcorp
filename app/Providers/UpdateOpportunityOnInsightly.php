<?php

namespace App\Providers;

use App\Providers\JobWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
