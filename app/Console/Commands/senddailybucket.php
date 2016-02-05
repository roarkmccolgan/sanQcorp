<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class senddailybucket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bucket:sendsms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sends every user thier bucket list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $users = User::has('buckets')->get();
        $responses = [];
        foreach ($users as $user) {
            //if($user->username=='roark'){
                $message = "Your Bucket List\n";
                foreach ($user->buckets as $bucket) {
                    $message.=$bucket->id.": ".$bucket->message."\n";
                }
                $bulkSms = new \anlutro\BulkSms\BulkSmsService('roark', 's4n1k@WP', 'https://bulksms.2way.co.za');
                $responses[] = $bulkSms->sendMessage($user->cell, rtrim($message));
            //}
        }
        $this->info('SMS\'s Sent.');
        $this->info('Bulk SMS responses: '.json_encode($responses));
    }
}
