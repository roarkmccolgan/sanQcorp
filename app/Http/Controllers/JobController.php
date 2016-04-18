<?php

namespace App\Http\Controllers;

use App\Company;
use App\Contacts;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AddJobRequest;
use App\Jobs;
use App\Section;
use App\System;
use Illuminate\Http\Request;
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
        $jobs = Jobs::with('contacts.company','sections.options')->get();
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
        $systems = System::with('tasks.materials')->get()->keyBy('id')->toArray();
        //return $systems;
        foreach ($systems as $key => $item) {
            $modifiedtasks = [];
            foreach ($item['tasks'] as $taskKey => $task) {
                $modifiedtasks[$task['alias']] = $task;
                $modifiedMaterials = [];
                foreach ($modifiedtasks[$task['alias']]['materials'] as $matkey => $mat) {
                    $modifiedMaterials[$mat['product_type']][$mat['id']] = $mat;
                }
                $modifiedtasks[$task['alias']]['materials'] = $modifiedMaterials;
            }
            $systems[$key]['tasks'] = $modifiedtasks;
        };

        //return ($systems);

        JavaScript::put([
            'job' => $job,
            'systems' => $systems
        ]);
        return view('jobs.build', compact(['job']));
        //return $job;
    }

    /**
     * Show the form for editing the job build
     *
     * @return \Illuminate\Http\Response
     */
    public function saveBuildJob(Jobs $job,Request $request)
    {
        //return $request->all();

        foreach ($request->input('section') as $secKey => $sec) {
            //sections//
            //
            $newSection = [
                'name'=>$sec['name'],
                'survey'=>$sec['survey']
            ];

            $section = Section::with('options')->find($secKey);
            if(!$section){
                $section = $job->sections()->create($newSection);
            }else{
                $section->name = $sec['name'];
                $section->survey = $sec['survey'];
                $section->save();

                $job->sections()->associate($section);
                $job->save();
            }
            //options
            foreach ($sec['options'] as $optKey => $opt) {

                //system
                $system = System::with('tasks')->findOrFail($opt['system']);

                //option
                $newOption = [
                    'name'  => $opt['name'],
                    'system_id'  => $opt['system'],
                    'description' => $opt['description'],
                    'size' => isset($opt['size'])?$opt['size'] : null,
                    'perimeter' => isset($opt['perimeter'])?$opt['perimeter'] : null,
                    'difficulty' => isset($opt['difficulty'])?$opt['difficulty'] : null,
                    'pitch' => isset($opt['pitch']) ? $opt['pitch'] : null,
                    'length' => isset($opt['length'])?$opt['length'] : null,
                    'height' => isset($opt['height'])?$opt['height'] : null,
                    'width' => isset($opt['width'])?$opt['width'] : null,
                    'labour_estimate' => $opt['labour_cost_price'],
                    'supervisor_estimate' => $opt['supervisor_cost_price'],
                    'days_estimate' => $opt['days'],
                    'total_estimate' => $opt['total_cost_price'],
                    'total_selling' => $opt['selling_price'],
                    'markup' => $opt['markup']
                ];

                $option = isset($opt['id']) ? Option::find($opt['id']) : false;
                if(!$option){
                    $option = $section->options()->create($newOption);
                }else{
                    $option->update($newOption);
                    $section->options()->associate($option);
                    $section->save();
                }

                //create / update relationship to system -> option
                $system->options()->save($option);

                $syncMaterials = [];
                foreach ($system->tasks as $taskKey => $task) {
                    if(isset($opt['tasks'][$task['alias']])){
                        $linkTo = $task->link_to;

                        $option->tasks()->attach($task['id'],[
                            'total' => $opt[$linkTo],
                        ]);
                        if(isset($opt['tasks'][$task['alias']]['materials'])){
                            
                            foreach ($opt['tasks'][$task['alias']]['materials'] as $materialType => $material) {
                                $syncMaterials[$material['material_id']]=[
                                    'qty' => $material['qty'],
                                    'price' => $material['price'],
                                    'cost_price' => $material['cost_price']
                                ];
                            }
                        }
                    }
                }
                //sync option materials
                $option->materials()->sync($syncMaterials);
            }
        }
        //return to jobs
        //return 'YAY!';
        $job->update(['status'=>'pending']);
        return redirect('/jobs');
    }
}
