<?php

namespace App\Providers;

use App\Job;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobWasCreated
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $job;
    public $user_insightly_id;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Job $job, $user_insightly_id)
    {
        //
        $this->job = $job;
        $this->user_insightly_id = $user_insightly_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
