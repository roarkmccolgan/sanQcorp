<?php

namespace App\Http\Controllers;

use App\Fuel;
use App\Guarantee;
use App\Job;
use App\JobInclude;
use App\Labour;
use App\Material;
use App\Option;
use App\Pandg;
use App\Providers\JobWasCreated;
use App\Providers\JobWasUpdated;
use App\Revision;
use App\Section;
use App\Survey;
use App\System;
use App\Task;
use App\Term;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Inertia\Inertia;

class JobDetailController extends Controller
{
    public function create(Job $job)
    {
        $systems = System::with('terms','photos','tasks.materials','tasks.variables','tasks.properties','labour','guarantee')->get()->keyBy('id')->toArray();
        $fuel = Fuel::whereDate('valid_from', '<=', Carbon::now())->where(function ($query) {
                $query->whereDate('valid_to', '>=', Carbon::now())
                      ->orWhere('valid_to', '=', null);
            })
            ->get();
        $fuel = $fuel->keyBy('type');
        $guarantees = Guarantee::all();
        $labour = Labour::all();
        $labour = $labour->map(function ($item, $key) {
            if($item->type == 'Supervisor' || $item->type == 'Driver'){
                $item->qty = 1;
                return $item;
            }elseif($item->type == 'Labourer'){
                $item->qty = 2;
                return $item;
            }elseif($item->type == 'Builder'){
                $item->qty = 2;
                return $item;
            }else{
                $item->qty = 0;
                return $item;
            }
        });
        $terms = Term::where('default',1)->get();
        $includes = JobInclude::all();
        $surveys = Survey::all();
        $basic_systems = $systems;
        $pandgs = Pandg::all();
        //$job->load('sections.options.materials.tasks');
        $users = User::all()->keyBy('id');
        //return $job['sections'];

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
        foreach ($job->photos as $photoKey => $photo) {
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
                            /*foreach ($material['tasks'] as $index => $matTask) {
                                if($matTask['id']==$task['id']){
                                    $areaconversion = $matTask['pivot']['area'] ? $matTask['pivot']['area']:$areaconversion;
                                }
                            }*/
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

       return Inertia::render('Jobs/Edit', [
            'job' => $job,
            'systems' => $systems,
            'guarantees' => $guarantees,
            'labour' => $labour,
            'terms' => $terms,
            'includes' => $includes,
            'surveys' => $surveys,
            'basic_systems' => $basic_systems,
            'pandg' => $pandgs,
            'users' => $users,
            'fuel' => $fuel,
        ]);
    }

    public function store(Job $job, Request $request)
    {
        //dd($request->input());
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
            ];
            if(isset($sec['save_survey'])){
                Survey::create(['survey'=>$sec['survey']]);
            }
            
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
                    'markup' => $opt['markup'],
                    //parameters
                    'area'=>isset($opt['area']) ? $opt['area'] : null,
                    'perimeter'=>isset($opt['perimeter']) ? $opt['perimeter'] : null,
                    'difficulty'=>isset($opt['difficulty']) ? $opt['difficulty'] : null,
                    'pitch'=>isset($opt['pitch']) ? $opt['pitch'] : null,
                    'volume'=>isset($opt['volume']) ? $opt['volume'] : null,
                    'length'=>isset($opt['length']) ? $opt['length'] : null,
                    'width'=>isset($opt['width']) ? $opt['width'] : null,
                    'height'=>isset($opt['height']) ?$opt['height'] : null,
                    'crosslaps'=> isset($opt['crosslaps']) ? $opt['crosslaps'] : null,
                    'ridge'=> isset($opt['ridge']) ? $opt['ridge'] : null,
                    'sidewall'=> isset($opt['sidewall']) ? $opt['sidewall'] : null,
                    'valleys'=> isset($opt['valleys']) ? $opt['valleys'] : null,
                    'honeycomb'=> isset($opt['honeycomb']) ? $opt['honeycomb'] : null,
                    'tieholes'=> isset($opt['tieholes']) ? $opt['tieholes'] : null,
                    'crack'=> isset($opt['crack']) ? $opt['crack'] : null,
                    'plug'=> isset($opt['plug']) ? $opt['plug'] : null,
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
                            $taskModel = Task::create($newTask);
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
                                    $matModel = Material::create($newMaterial);
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
                    $exist = Pandg::where('id',$pandg['id'])->first();
                    $exist->update($details);
                }else{
                    $new = Pandg::create($details);
                    //$job->pandg()->create($details);
                }
            }
        }
        if(!empty($request->input('terms'))){
            $job->terms()->sync($request->input('terms'));
        }
        if(!empty($request->input('includes'))){
            $job->jobincludes()->sync($request->input('includes'));
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
        // return $request->input('html');
        // dd();
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

    private function generateOrderNumber(){
        $maxId = DB::table('jobs')->max('id');
        $orderNum = "SAN".sprintf('%04d', $maxId+1)."-".date("y");
        return $orderNum;
    }
}
