<?php

namespace App\Http\Controllers;

use App\File;
use App\Job;
use App\Option;
use App\Order;
use App\Providers\JobWasAccepted;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(AddOrderRequest $request)
    {
    	//return $request->all();
    	//
    	$job = Job::find($request->input('job.id'));

    	$filePath = public_path().'/job/'.$job->order_number.'/';

        if(!file_exists($filePath)){
            if (!mkdir($filePath, 0775, true)) {
                dd('Failed to create folders...');
            }
        }
        if($request->file('upload')){
            $file = $request->file('upload');
            if(!$file->move($filePath,$file->getClientOriginalname())){
                return redirect('/jobs');
            };

            $meta = array();
            $meta['fileType'] = $file->getClientOriginalExtension();
            $meta['size'] = $file->getClientSize();

            $orderDoc = new File([
                'name' => $file->getClientOriginalName(),
                'meta' => json_encode($meta)
            ]);
        }
            

    	$order = new Order;
    	$order->job_id = $job->id;
    	$order->contact_id = $request->input('contact_id');
    	$order->user_id = 1;
    	$order->save();
        if(isset($orderDoc)){
            $order->files()->save($orderDoc);
        }
        
    	$order->job()->associate($job);

    	//$job->order()->associate($order);

    	foreach ($request->input('job.option') as $id => $option) {
    		$option = Option::with('section')->find($id);
    		$option->section->update(['accepted'=>1]);
    		$option->update(['accepted'=>1]);
    	}

        $requested_start_date = Carbon::parse($request->input('job.start_date'));

    	if($job->update(['accepted'=>1,'status'=>'accepted','requested_start_date'=>$requested_start_date])){
            Event::fire(new JobWasAccepted($job));
        }


    	//$job = Jobs::find($request->input('job.id'));
    	//return $job;
        return redirect('/jobs');
    }
}
