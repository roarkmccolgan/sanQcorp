<?php

namespace App\Events;

use App\Events\Event;
use App\Jobs;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class JobWasUpdated extends Event
{
    use SerializesModels;

    public $job;
    public $user_insightly_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Jobs $job, $user_insightly_id)
    {
        $this->job = $job;
        $this->user_insightly_id = $user_insightly_id;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
