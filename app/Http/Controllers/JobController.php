<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddJobRequest;
use App\Http\Controllers\Controller;
use App\Jobs;
use App\Company;
use App\Contacts;
use App\System;
use JavaScript;

class JobController extends Controller
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

    public function showJobs()
    {
        $jobs = Jobs::with('contacts.company')->get();
        //return $jobs;
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createJob()
    {
        return view('jobs.create');
    }

    /**
     * Save a new job.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveJob(AddJobRequest $request)
    {
        //return $request->all();

        $company_id = $request->input('company_id');
        $new_contacts=[];

        if(!$company_id){
            $company = Company::create([
                'name'=>$request->input('company_name'),
                'address1'=>$request->input('company_address1'),
                'address2'=>$request->input('company_address2'),
                'address3'=>$request->input('company_address3'),
                'post_code'=>$request->input('company_post_code'),
                'vat'=>$request->input('company_vat')
            ]);
            $company_id = $company->id;
        }

        if(!empty($request->input('new_contact'))){
            foreach ($request->input('new_contact') as $new_contact) {
                $contact = Contacts::create([
                    'company_id'=>$company_id,
                    'first_name'=>$new_contact['first_name'],
                    'last_name'=>$new_contact['last_name'],
                    'job_title'=>$new_contact['job_title'],
                    'department'=>$new_contact['department'],
                    'region'=>$new_contact['region'],
                    'country'=>$new_contact['country'],
                    'contact1'=>$new_contact['contact1'],
                    'contact2'=>$new_contact['contact2'],
                    'contact3'=>$new_contact['contact3'],
                    'email'=>$new_contact['email']
                ]);
                $new_contacts[]=$contact->id;
            }
        }
        $distance = explode(" ", $request->input('distance'));
        
        $job_contacts = $request->input('contact') ? array_merge($request->input('contact'),$new_contacts) : $new_contacts;

        $job = Jobs::create([
            'order_number'=>$request->input('order_number'),
            'name'=>$request->input('name'),
            'distance'=>$distance[0],
            'status'=>'build',
            'estate'=>$request->input('estate'),
            'estate_address'=>$request->input('estate_address'),
            'estate_suburb'=>$request->input('estate_suburb'),
            'address'=>$request->input('address'),
            'suburb'=>$request->input('suburb'),
            'city'=>$request->input('city'),
            'country'=>$request->input('country')
        ]);
        $job->contacts()->sync($job_contacts);

        return redirect('/jobs');
    }

    /**
     * Show the form for editing the job build
     *
     * @return \Illuminate\Http\Response
     */
    public function showBuildJob(Jobs $job)
    {
        $systems = System::with('materials')->get()->keyBy('id')->toArray();
        foreach ($systems as $key => $item) {
            $modified_systems = [];
            foreach ($item['materials'] as $matkey => $mat) {
                $modified_systems[$mat['product_type']][$mat['id']] = $mat;
            };
            //$item['materials'] = $modified_systems;
            $systems[$key]['materials'] = $modified_systems;
        };

        //dd($systems);

        JavaScript::put([
            'job' => $job,
            'systems' => $systems
        ]);
        return view('jobs.build', compact(['job']));
        //return $job;
    }
}
