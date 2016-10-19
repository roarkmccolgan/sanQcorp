<?php

namespace App\Http\Controllers;

use App\Events\JobWasAccepted;
use App\Files;
use App\Http\Requests;
use App\Http\Requests\AddOrderRequest;
use App\Jobs;
use App\Option;
use App\Order;
use App\Orders;
use Carbon\Carbon;
use Event;
use Illuminate\Http\Request;
use Mail;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function showOrders()
    {
        /*$job=Jobs::with(
            ['sections.options' => function ($query) {
                    $query->where('accepted', '=', 1);
                }
            ],
            'sections.options.materials',
            'sections.options.tasks'
        )->find(7316);

        Mail::send('email.jobaccepted', ['job'=>$job], function($message) use($job){
            $message->to('roark@sanika.co.za','Roark McColgan')->subject($job->order_number.' - Accepted');
        });*/

        // $orders = Orders::all();

        //return view('orders.index', compact('orders'));
        //return view('email.jobaccepted', ['job'=>$job]);
    }

    /**
     * Save a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveOrder(AddOrderRequest $request)
    {
    	//return $request->all();
    	//
    	$job = Jobs::find($request->input('job.id'));

    	$filePath = public_path().'/job/'.$job->order_number.'/';

        if(!file_exists($filePath)){
            if (!mkdir($filePath, 0775, true)) {
                dd('Failed to create folders...');
            }
        }
        $file = $request->file('upload');
        if(!$file->move($filePath,$file->getClientOriginalname())){
        	return redirect('/jobs');
        };

        $meta = array();
        $meta['type'] = $file->getClientOriginalExtension();
    	$meta['size'] = $file->getClientSize();

    	$orderDoc = new Files([
    		'name' => $file->getClientOriginalName(),
    		'meta' => json_encode($meta)
    	]);

    	$order = new Order;
    	$order->job_id = $job->id;
    	$order->contact_id = $request->input('contact_id');
    	$order->user_id = 1;
    	$order->save();

    	$order->files()->save($orderDoc);
    	
    	$order->job()->associate($job);

    	//$job->order()->associate($order);

    	foreach ($request->input('job.option') as $id => $option) {
    		$option = Option::with('section')->find($id);
    		$option->section->update(['accepted'=>1]);
    		$option->update(['accepted'=>1]);
    	}

        $requested_start_date = Carbon::parse($request->input('job.start_date'));

    	if($job->update(['accepted'=>1,'status'=>'accepted','requested_start_date'=>$requested_start_date])){
            Event::fire(new JobWasAccepted($job->id));
        }


    	//$job = Jobs::find($request->input('job.id'));
    	//return $job;
        return redirect('/jobs');
    }
}
