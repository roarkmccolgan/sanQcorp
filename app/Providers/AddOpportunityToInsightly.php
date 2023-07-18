<?php

namespace App\Providers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

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
     * @return void
     */
    public function handle(JobWasCreated $event)
    {
        $job = $event->job;
        $user_insightly_id = $event->user_insightly_id;

        Log::info('This is received from the event class: '.$user_insightly_id);

        //send guzzle request
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.insight.ly/v2.1/']);
        $username = config('insightly.apikey'); //api key
        $password = ''; //blank / not needed
        $url = 'Opportunities';
        try {
            $request = $client->request('POST', $url, [
                'auth' => [$username, $password],
                'json' => [
                    'OPPORTUNITY_STATE' => 'OPEN',
                    'OPPORTUNITY_NAME' => $job->order_number.' - '.$job->name,
                    'BID_AMOUNT' => intval($job->value),
                    'BID_CURRENCY' => 'ZAR',
                    'BID_TYPE' => 'Fixed Bid',
                    'RESPONSIBLE_USER_ID' => $user_insightly_id,
                    'OWNER_USER_ID' => $user_insightly_id,
                ],
            ]);
            $code = $request->getStatusCode();
            $reason = $request->getReasonPhrase();
            $body = $request->getBody();
            $jsonResponse = json_decode((string) $body, true);

            $job->update(['insightly_opportunity_id' => $jsonResponse['OPPORTUNITY_ID']]);

            return $jsonResponse['OPPORTUNITY_ID'];
        } catch (GuzzleHttp\Exception\RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }
}
