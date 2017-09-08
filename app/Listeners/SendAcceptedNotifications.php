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
        $job = $event->job;
        $opportunity_id = $job->insightly_opportunity_id;
        $user_insightly_id = $job->user->user_insightly_id;

        //send guzzle request
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.insight.ly/v2.1/']);
        $username = config('insightly.apikey');
        $password = ''; //blank / not needed
        $url = 'Opportunities';
        try {
            $request = $client->request('PUT', $url, [
                'auth' => [$username, $password],
                'json' => [
                    'OPPORTUNITY_ID' => $opportunity_id,
                    'OPPORTUNITY_STATE' => "Won",
                ]
            ]);
            $code = $request->getStatusCode();
            $reason = $request->getReasonPhrase();
            $body = $request->getBody();
            $jsonResponse = json_decode((string) $body, true);

            return $jsonResponse['OPPORTUNITY_ID'];

        } catch (GuzzleHttp\Exception\RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }

        $job->load(['sections.options' => function ($query) {
            $query->where('accepted', '=', 1);
        }]);

        Mail::queue('email.jobaccepted', ['job'=>$job], function($message) use($job){
            $message->to([
                'roarkmccolgan@gmail.com',
                /*'sandor@sanika.co.za',
                'management@sanika.co.za'*/
            ])->subject($job->order_number.' - Accepted');
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
