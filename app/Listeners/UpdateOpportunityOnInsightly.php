<?php

namespace App\Listeners;

use App\Events\JobWasUpdated;
use App\Jobs;
use Log;
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
        $job = $event->job;
        $opportunity_id = $job->insightly_opportunity_id;
        $user_insightly_id = $event->user_insightly_id;

        //send guzzle request
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.insight.ly/v2.1/']);
        $username = 'bdd2248f-433e-43cd-b148-6231a3d5418f'; //api key
        $password = ''; //blank / not needed
        $url = 'Opportunities';
        try {
            $request = $client->request('PUT', $url, [
                'auth' => [$username, $password],
                'json' => [
                    'OPPORTUNITY_ID' => $opportunity_id,
                    'OPPORTUNITY_NAME' => $job->name.' - '.$job->order_number,
                    'BID_AMOUNT' => intval($job->value),
                    'BID_CURRENCY' => 'ZAR',
                    'BID_TYPE' => 'Fixed Bid',
                    'RESPONSIBLE_USER_ID' => $user_insightly_id,
                    'OWNER_USER_ID' => $user_insightly_id,
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
    }
}
