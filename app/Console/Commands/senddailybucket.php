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
        $bulkSms = new \anlutro\BulkSms\BulkSmsService(config('bulksms.username'), config('bulksms.password'), config('bulksms.baseurl'));
        $users = User::has('buckets')->get();
        $messages = [];
        foreach ($users as $user) {
            //if($user->username=='roark'){
                $message = "Your Bucket List\n";
                foreach ($user->buckets as $bucket) {
                    $message.=$bucket->id.": ".$bucket->message."\n";
                }
                $messages[] = new \anlutro\BulkSms\Message($user->cell, rtrim($message));
            //}
        }
        $bulkResponse = $bulkSms->sendBulkMessages($messages);
        $this->info('SMS\'s Sent.');
        $this->info('Bulk SMS batch id: '.$bulkResponse['batch_id']);
    }
}
