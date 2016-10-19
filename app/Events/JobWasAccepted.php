<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class JobWasAccepted extends Event
{
    use SerializesModels;
    public $jobId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($jobId)
    {
        $this->jobId = $jobId;
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
