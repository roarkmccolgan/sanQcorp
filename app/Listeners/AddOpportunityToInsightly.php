<?php

namespace App\Listeners;

use App\Events\JobWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs;

class AddOpportunityToInsightly implements ShouldQueue
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
     * @param  JobWasCreated  $event
     * @return void
     */
    public function handle(JobWasCreated $event)
    {
        $job = $event->job;
        // $job->load(['sections.options' => function ($query) {
        //     $query->where('accepted', '=', 1);
        // },'user']);

        //send guzzle request
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.insight.ly/v2.1/']);
        $username = 'bdd2248f-433e-43cd-b148-6231a3d5418f'; //api key
        $password = ''; //blank / not needed
        $url = 'Opportunities';
        try {
            $request = $client->request('POST', $url, [
                'auth' => [$username, $password],
                'json' => [
                    'OPPORTUNITY_STATE' => 'Open',
                    'OPPORTUNITY_NAME' => $job->name.' - '.$job->order_number,
                    'BID_AMOUNT' => intval($job->value),
                    'BID_CURRENCY' => 'ZAR',
                    'BID_TYPE' => 'Fixed Bid'
                ]
            ]);
            $code = $response->getStatusCode();
            return $code;

        } catch (GuzzleHttp\Exception\RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }

    }
}
