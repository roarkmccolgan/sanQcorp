<?php

namespace App\Http\Controllers;

use App\Company;
use App\Contacts;
use App\Employees;
use App\Events\JobWasCreated;
use App\Events\JobWasUpdated;
use App\Files;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\GeneratePdfTrait;
use App\Http\Requests;
use App\Http\Requests\AddJobRequest;
use App\Jobs;
use App\Materials;
use App\Option;
use App\PandG;
use App\Revision;
use App\Section;
use App\System;
use App\Tasks;
use App\Term;
use App\User;
use DB;
use Event;
use Illuminate\Http\Request;
use JavaScript;

class JobController extends Controller
{
    use GeneratePdfTrait;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function testInsightly()
    {
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
                    'OPPORTUNITY_NAME' => 'Roark Test Dummy 2'
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
        $url = 'Opportunities/12289885';
        /*//$url = 'OpportunityStateReasons';
        try {
            $request = $client->request('GET', $url, [
                'auth' => [$username, $password]
            ]);
            $code = $request->getStatusCode();
            $reason = $request->getReasonPhrase();
            $body = $request->getBody();
            return json_decode((string) $body, true);
            
        } catch (GuzzleHttp\Exception\RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }*/
    }

    public function showJobs()
    {
        $jobs = Jobs::with('contacts.company','sections.options')->get();

        $vueJob = [];
        foreach ($jobs as $key => $job) {
            $vueJob[$job->id] = [
                'key'=> $key,
                'show'=> false,
                'sections'=>count($job->sections)
            ];
        }
        //return $vueJob;
        JavaScript::put([
            'jobs' => $vueJob
        ]);

        return view('jobs.index', compact(['jobs','file']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createJob(Request $request)
    {
        JavaScript::put([
            'old' => $request->old(),
            'users' => $users = User::all()->keyBy('id'),
        ]);
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
        //return $this->generateOrderNumber();

        $company_id = $request->input('company_id');
        $new_contacts=[];

        if(!$company_id){
            //return $request->all();
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
                if($new_contact['first_name']!=="" && $new_contact['last_name']!==""){
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
        }
        $distance = explode(" ", $request->input('distance'));
        $contacts = [];

        if($request->input('contact')){
            foreach ($request->input('contact') as $key => $contact) {
                if(isset($contact['id'])){
                    $contacts[] = $contact['id'];
                }
            }
        }
        
        $job_contacts = array_merge($contacts ,$new_contacts);
        //return $job_contacts;

        $job = Jobs::create([
            'order_number'=>$this->generateOrderNumber(),
            'user_id'=>null,
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

        //check for custom job
        if($request->input('custom')){
            $job->value=$request->input('value');
            $job->user_id=$request->input('user_id');
            $job->status='pending';
            $job->custom=true;
            $job->save();
            //upload file
            if ($request->file('quote')->isValid()) {
                $quote = $request->file('quote');
                $filePath = public_path().'/job/'.$job->order_number.'/';
                if(!file_exists($filePath)){
                    if (!mkdir($filePath, 0775, true)) {
                        abort('Failed to create folders, contact Roark');
                    }
                }
                $newname = $job->order_number.'-'.$job->name.'.'.$quote->getClientOriginalExtension();
                $quote->move($filePath, $newname);

                $meta = array();
                $meta['fileType'] = $quote->getClientOriginalExtension();
                $meta['path'] = $filePath;
                $meta['type'] = 'quote';

                $quoteDoc = new Files([
                    'name' => $newname,
                    'meta' => json_encode($meta)
                ]);

                $job->files()->save($quoteDoc);
            }
            $user = User::find($job->user_id);
            Event::fire(new JobWasCreated($job,$user->insightly_id));
        }
        //return "Success";
        return redirect('/jobs/'.$job->id.'/build');
    }

    /**
     * Show the form for editing the job build
     *
     * @return \Illuminate\Http\Response
     */
    public function showBuildJob(Jobs $job)
    {

        $systems = System::with('terms','photos','tasks.materials','tasks.variables')->get()->keyBy('id')->toArray();
        $terms = Term::where('default',1)->get();
        $basic_systems = $systems;
        $pandgs = PandG::all();
        $job = $job->toArray();
        $users = User::all()->keyBy('id');
        
        //return $job;
        

        foreach ($systems as $key => $item) {
            $modifiedtasks = [];
            foreach ($item['tasks'] as $taskKey => $task) {
                $modifiedtasks[$task['alias']] = $task;
                $modifiedMaterials = [];
                $modifiedVariables = [];
                foreach ($modifiedtasks[$task['alias']]['materials'] as $matkey => $mat) {
                    $modifiedMaterials[$mat['product_type']][$mat['id']] = $mat;
                }
                foreach ($modifiedtasks[$task['alias']]['variables'] as $varKey => $var) {
                    $slug = str_slug($var['name']);
                    $modifiedVariables[$slug][] = $var;
                }
                $modifiedtasks[$task['alias']]['materials'] = $modifiedMaterials;
                $modifiedtasks[$task['alias']]['variables'] = $modifiedVariables;
            }
            //sort by pivot order value
            uasort($modifiedtasks, function($a, $b) {
                return $a['pivot']['order'] - $b['pivot']['order'];
            });
            $systems[$key]['tasks'] = $modifiedtasks;
        };
        //return $systems;
        foreach ($job['photos'] as $photoKey => $photo) {
            $meta = json_decode($photo['meta']);
            if($meta->type==='main'){
                $job['mainPhoto']['id'] = $photo['id'];
                $job['mainPhoto']['photo'] = $photo['photo'];
                unset($job['photos'][$photoKey]);
            }
        }
        //return $job['images'];


        foreach ($job['sections'] as $secKey => $section) {
            $job['sections'][$secKey]['images'] = [];
            if(!empty($section['photos'])){
                foreach ($section['photos'] as $photoKey => $photo) {
                    $job['sections'][$secKey]['photos'][$photoKey]['meta'] = json_decode($photo['meta']);
                    $job['sections'][$secKey]['images'][$job['sections'][$secKey]['photos'][$photoKey]['meta']->type]['id'] = $photo['id'];
                    $job['sections'][$secKey]['images'][$job['sections'][$secKey]['photos'][$photoKey]['meta']->type]['photo'] = $photo['photo'];
                }
            }else{
                $job['sections'][$secKey]['photos'] = [];
            }
            foreach ($section['options'] as $optKey => $option) {

                foreach ($option['tasks'] as $tasKey => $task) {
                    $reorderSystemTasks = false;
                    if($task['alias']=='custom'){
                        $task['alias'] = strtolower('custom-'.str_replace(" ", "", $task['name']));
                    }
                    $task['order'] = $task['pivot']['order'];
                    $task['days'] = $task['pivot']['days'];
                    $task['total_labour'] = $task['pivot']['total_labour_price'];
                    $task['total_supervisor'] = $task['pivot']['total_supervisor_price'];
                    $task['total_materials'] = $task['pivot']['total_materials_price'];
                    $task['total_cost_price'] = $task['pivot']['total_cost_price'];
                    $task['system_id'] = $option['system_id'];
                    

                    $newMaterials = [];
                    foreach ($option['materials'] as $matKey => $material) {
                        if($material['pivot']['task']==$task['alias']){
                            $flag = $material['pivot']['cost_price']!=$material['cost_price'] ? true:false;
                            $areaconversion = false;
                            foreach ($systems[$option['system_id']]['tasks'] as $sysTaskKey=>$sysTask){
                                foreach ($sysTask['materials'] as $sysMatType => $sysMats) {
                                    foreach ($sysMats as $sysMatId => $sysMat) {
                                        if($sysMatId==$material['id']){
                                            $areaconversion = $sysMat['pivot']['area'] ? $sysMat['pivot']['area']:$areaconversion;
                                        }
                                    }
                                }
                            }
                            $newMaterials[] = [
                                'id' => $material['id'],
                                'name' => $material['name'],
                                'product_type' => $material['product_type'],
                                'coverage' => $material['coverage'],
                                'pack_size' => $material['pack_size'],
                                'cost_price' => $material['cost_price'],
                                'qty' => $material['pivot']['qty'],
                                'price' => $material['pivot']['price'],
                                'stock' => $material['stock'],
                                'unit_of_measure' => $material['unit_of_measure'],
                                'task' => $task['alias'],
                                'areaconversion' => $areaconversion,
                                'flag'=> $flag
                            ];
                        }
                    }
                    $task['materials'] = $newMaterials;
                    $job['sections'][$secKey]['options'][$optKey]['tasks'][$tasKey] = $task;
                   

                    //If a custom task exists add it to the system tasks
                    if(!isset($systems[$job['sections'][$secKey]['options'][$optKey]['system']['id']]['tasks'][$task['alias']])){
                        $reorderSystemTasks = true;
                        $systems[$option['system_id']]['tasks'][$task['alias']] = $task;
                    }
                    //Ensure order of system tasks matched option tasks
                    $systems[$option['system_id']]['tasks'][$task['alias']]['pivot']['order'] = $task['order'];

                    $job['sections'][$secKey]['options'][$optKey]['system']['tasks'][$task['alias']] = $task;

                    if($reorderSystemTasks){
                        uasort($systems[$option['system_id']]['tasks'], function($a, $b) {
                            return $a['pivot']['order'] - $b['pivot']['order'];
                        });
                    }
                }
                $job['sections'][$secKey]['options'][$optKey]['show'] = false;
            }
            $job['sections'][$secKey]['show'] = false;
        }
        //return $job;
        
        $job = (object) $job;
        //dd($job);

        JavaScript::put([
            'job' => $job,
            'systems' => $systems,
            'terms' => $terms,
            'basic_systems' => $basic_systems,
            'pandg' => $pandgs,
            'users' => $users
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
        
        if($request->input('_santoken')){
            $job->sections->delete();
            foreach ($job->sections as $section) {
                $section->delete();
            }
        }
        $jobValue = 0;

        foreach ($request->input('section') as $secKey => $sec) {
            //sections//
            //
            $newSection = [
                'name'=>$sec['name'],
                'survey'=>$sec['survey'],
                'area'=>isset($sec['area']) ? $sec['area'] : null,
                'perimeter'=>isset($sec['perimeter']) ? $sec['perimeter'] : null,
                'difficulty'=>isset($sec['difficulty']) ? $sec['difficulty'] : null,
                'pitch'=>isset($sec['pitch']) ? $sec['pitch'] : null,
                'volume'=>isset($sec['volume']) ? $sec['volume'] : null,
                'length'=>isset($sec['length']) ? $sec['length'] : null,
                'width'=>isset($sec['width']) ? $sec['width'] : null,
                'height'=>isset($sec['height']) ?$sec['height'] : null
            ];
            //return $newSection;         

            $section = Section::with('options')->find($sec['id']);
            //return $section;
            if(!$section){
                $section = $job->sections()->create($newSection);
            }else{
                $section->update($newSection);
            }


            $section->photos()->delete();
            if(isset($sec['photos'])){
                foreach ($sec['photos'] as $photKey => $photo) {
                    if($photo['photo']!=''){
                        $section->photos()->create(['photo'=>$photo['photo'], 'meta'=>json_encode(['type'=>$photKey])]);
                    }
                }
            }
                

            //options
            $maxSellingPrice = 0;
            foreach ($sec['options'] as $optKey => $opt) {
                //system
                $system = System::with('tasks')->findOrFail($opt['system']);

                //option
                $newOption = [
                    'name'  => $opt['name'],
                    'system_id'  => $opt['system'],
                    'description' => $opt['description'],
                    'total_labour' => $opt['total_labour'],
                    'total_supervisor' => $opt['total_supervisor'],
                    'days' => $opt['days'],
                    'total_materials' => $opt['total_materials'],
                    'total_cost_price' => $opt['total_cost_price'],
                    'selling_price' => $opt['selling_price'],
                    'markup' => $opt['markup']
                ];
                $maxSellingPrice = $opt['selling_price']>$maxSellingPrice ? $opt['selling_price']:$maxSellingPrice;

                $option = isset($opt['id']) ? Option::find($opt['id']) : false;
                if(!$option){
                    $option = $section->options()->create($newOption);
                }else{
                    $option->update($newOption);
                }

                //notes
                $option->notes()->delete();
                if(isset($opt['notes']) && count($opt['notes'])>0){
                    foreach ($opt['notes'] as $noteKey => $note) {
                        if($note['note']!=''){
                            $option->notes()->create(['note'=>$note['note']]);
                        }
                    }
                }

                if(!empty($opt['tasks'])){
                    $syncTasks = [];
                    foreach ($opt['tasks'] as $taskKey => $task) {
                        //dd($task);
                        $variable = null;
                        if(isset($task['variables']) && count($task['variables'])>0){
                            foreach ($task['variables'] as $typeKey => $type) {
                                foreach ($type as $varKey => $var) {
                                    if($var!=''){
                                        $variable = $var;
                                    }
                                }
                            }
                        }
                        
                        if($task['id']==0 || $task['id']=="0"){ //custom Task
                            $newTask = [
                                'name'=> $task['name'],
                                'description'=> $task['description'],
                                'alias'=> 'custom',
                                'unit_of_measure'=> $task['unit_of_measure'],
                                'link_to'=> $task['link_to'],
                                'rate'=> $task['rate']
                            ];
                            $taskModel = Tasks::create($newTask);
                            $task['id'] = $taskModel->id;
                            if(!empty($opt['materials'][$taskKey])){
                                $syncCusMaterials = [];
                                foreach ($opt['materials'][$taskKey] as $cusKey => $cusMaterial) {
                                    $newMaterial = [
                                        'name'=> $cusMaterial['name'],
                                        'pack_size'=> $cusMaterial['pack_size'],
                                        'cost_price'=> $cusMaterial['cost_price'],
                                        'unit_of_measure'=> $cusMaterial['unit_of_measure'],
                                        'product_type'=> $cusKey,
                                        'coverage'=> $cusMaterial['coverage']
                                    ];
                                    $matModel = Materials::create($newMaterial);
                                    $opt['materials'][$taskKey][$cusKey]['id'] = $matModel->id;
                                    $syncCusMaterials[] = $matModel->id;
                                }
                                if(!empty($syncCusMaterials)){
                                    $taskModel->materials()->sync($syncCusMaterials);
                                }
                            }
                        }
                        $syncTasks[$task['id']] = [
                            'order' => $task['order'],
                            'days' => $task['days'],
                            'difficulty' => isset($task['difficulty']) ? $task['difficulty'] : null,
                            'total_labour_price' => isset($task['total_labour_price']) ? $task['total_labour_price'] : null,
                            'total_supervisor_price' => isset($task['total_supervisor_price']) ? $task['total_supervisor_price'] : null,
                            'total_materials_price' => isset($task['total_materials_price']) ? $task['total_materials_price'] : null,
                            'total' => $task['quantity'],
                            'variable_id' => $variable
                        ];
                    }
                    $option->tasks()->sync($syncTasks);
                }

                if(!empty($opt['materials'])){
                    $syncMaterials = [];
                    foreach ($opt['materials'] as $taskType => $materials) {
                        foreach ($materials as $materialType => $material) {
                            if($material['qty']!='0' && $material['qty']!=0){
                                $syncMaterials[$material['id']]=[
                                    'qty' => $material['qty'],
                                    'price' => $material['price'],
                                    'cost_price' => $material['cost_price'],
                                    'product_type' => $material['product_type'],
                                    'task' => $taskType,
                                ];
                            }
                        }
                    }
                    $option->materials()->sync($syncMaterials);
                }                
            }
            $jobValue += $maxSellingPrice;
        }
        //return to jobs
        //return 'YAY!'
        
        $job->photos()->delete();
        if(!empty($request->input('photos'))){
            foreach ($request->input('photos') as $photKey => $photo) {
                if($photo['photo']!=''){
                    $job->photos()->create(['photo'=>$photo['photo'],'meta'=>json_encode(['type'=>$photKey])]);
                }
            }
        }
        if($request->input('mainPhoto.photo')!=''){
            $job->photos()->create(['photo'=>$request->input('mainPhoto.photo'),'meta'=>json_encode(['type'=>'main'])]);
        }

        if(!empty($request->input('psandgs'))){
            foreach ($request->input('psandgs') as $pandgKey => $pandg) {
                $details = [
                    'name'=>$pandg['name'],
                    'description'=>isset($pandg['description']) ? $pandg['description']:null,
                    'pandg_category_id'=>1,
                    'jobs_id'=>$job->id,
                    'rate'=>$pandg['rate'],
                    'qty'=>$pandg['qty'],
                    'period'=>$pandg['period']
                ];

                if($pandg['id']!=''){
                    $exist = PandG::where('id',$pandg['id'])->first();
                    $exist->update($details);
                }else{
                    $new = PandG::create($details);
                    //$job->pandg()->create($details);
                }
            }
        }
        if(!empty($request->input('terms'))){
            $job->terms()->sync($request->input('terms'));
        }
        $newEvent = $job->status=='build' ? true:false;
        $job->status = 'pending';
        $job->user_id = $request->input('user_id');
        $job->value = $jobValue;
        $job->title1 = $request->input('title1');
        $job->title2 = $request->input('title2');
        $job->title = $request->input('title');
        $job->save();

        if(!$request->input('_santoken')){
            //add Revision
            
            $revision = new Revision(['data'=>serialize($request->all())]);
            $job->revisions()->save($revision);
        }
        //Trait GeneratePDF
        $this->WKtoHTML($request->input('html'),$job->order_number.'-'.$job->name.'.pdf',$job->order_number,'save');

        $user = User::find($request->input('user_id'));
        if($newEvent){
            Event::fire(new JobWasCreated($job,$user->insightly_id));
        }else{
            Event::fire(new JobWasUpdated($job,$user->insightly_id));
        }
        //return 'YAY '/*.$user->insightly_id*/;
        return redirect('/jobs');
    }


    //CURRENT JOBS
    public function showCurrentJobs(){
        $jobs = Jobs::with('contacts.company','sections.options')->get();
        //return $jobs;
        return view('jobs.current', compact('jobs'));
    }

    /**
     * Show the form for editing the current job
     *
     * @return \Illuminate\Http\Response
     */
    public function editCurrentJob($job)
    {
        $job = Jobs::with('sections')->findOrFail($job);
        $employees = Employees::get(['id', 'name AS text'])->keyBy('id');
        //return $employees;
        foreach ($job->sections as $secKey => $section) {
            if($section->accepted){
                $section->load(['options' => function ($query) {
                    $query->where('accepted', '=', 1);
                }]);
            }
        }

        //$sections = Section::with('options.materials','options.tasks.materials')->where('jobs_id',$job->id)->get();

        $job->sections->each(function($section,$secKey){
            $section->options->each(function($option,$optKey){
                $option->tasks->each(function($task,$taskKey){
                    $task->groupedMaterials = $task->materials->GroupBy('product_type');
                });
            });
        });

        //return $job;

        JavaScript::put([
            'job'=>$job,
            'employees' => $employees
        ]);
        return view('jobs.editCurrent', compact(['job']));
    }

    //Helpers
    
    private function generateOrderNumber(){
        $maxId = DB::table('jobs')->max('id');
        $orderNum = "SAN".sprintf('%04d', $maxId+1)."-".date("y");
        return $orderNum;
    }
}
