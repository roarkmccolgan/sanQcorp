<?php

namespace App\Http\Controllers;

use App\Bucket;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class BucketController extends Controller
{
    public function index()
    {
        $buckets = Bucket::all();

        return view('buckets.index', compact('buckets'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $name = explode('@', $input['sender']);
        $user = User::where('username', $name[0])->get()->first();
        //Return $input['sender']." ".$input['subject'];
        if ($user !== null) {
            /*if($input['attachment-count']>0){
                $attachments = [];
                for($i=0;$i<=$input['attachment-count'];$i++){
                    if ($input->file('attachment-'+$i)->isValid()) {
                        $file = $input->file('attachment-'+$i);
                        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));

                    }

                }
            }*/
            Bucket::create([
                'username' => $name[0],
                'fromEmail' => $input['sender'],
                'message' => $input['subject'],
                'calendar' => Carbon::now(),
                'user_id' => $user->id,
            ]);
        }

        //return $input;
        //$input['calendar'] = Carbon::now();

        //Bucket::create($input);
        return new Response('success', 200);
    }

    public function destroy($id)
    {
        $bucket = Bucket::findOrFail($id);
        $bucket->delete();

        return Redirect::to('/bucket');
    }

    public function smsCommand(Request $request)
    {
        $input = $request->all();
        Log::info('SMS Parameters: '.json_encode($input));
        $recipient = $input['sender'];
        $message = $input['message'];
        if (strpos($message, 'delete') !== false || strpos($message, 'Delete') !== false || strpos($message, 'DELETE') !== false) {
            //user would like to delete bucket/s
            $parts = explode(' ', $message);
            $deleted = '';
            for ($i = 1; $i <= (count($parts) - 1); $i++) {
                $bucket = Bucket::where('id', $parts[$i])->get()->first();
                if ($bucket !== null && $bucket->user->cell == str_replace('+', '', $input['sender'])) {
                    $bucket->delete();
                    $deleted .= ' ' + $parts[$i];
                } else {
                    $deleted = 'No bucket '.json_encode($parts[$i]);
                }
            }

            return new Response('success '.$deleted, 200);
        } else {
            return new Response('fail', 200);
        }

        return new Response('No input', 200);
    }
}
