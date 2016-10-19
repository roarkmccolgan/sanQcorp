<?php

namespace App\Listeners;

use App\Events\JobWasAccepted;
use App\Jobs;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendAcceptedNotifications implements ShouldQueue
{
    use InteractsWithQueue;

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
        $job = Jobs::with(
            ['sections.options' => function ($query) {
                    $query->where('accepted', '=', 1);
                }
            ]
        )->find($event->jobId);

        Mail::queue('email.jobaccepted', ['job'=>$job], function($message) use($job){
            $message->to('roarkmccolgan@gmail.com','Roark McColgan')->subject($job->order_number.' - Accepted');
        });
        /*Mail::queue('email.jobaccepted', ['job'=>$job], function($message) use($job){
            $message->to('sandor@sanika.co.za','Sandor Dowling')->subject($job->order_number.' - Accepted');
        });
        Mail::queue('email.jobaccepted', ['job'=>$job], function($message) use($job){
            $message->to('tanika@sanika.co.za','Tanika McColgan')->subject($job->order_number.' - Accepted');
        });*/
        // dd($option->toArray());
    }
}
