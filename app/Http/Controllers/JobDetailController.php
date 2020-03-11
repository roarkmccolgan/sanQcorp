<?php

namespace App\Http\Controllers;

use App\Fuel;
use App\Guarantee;
use App\Job;
use App\JobInclude;
use App\Labour;
use App\Material;
use App\Nightshift;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\Browsershot\Browsershot;

class JobDetailController extends Controller
{
    public function create(Job $job)
    {
        $job->load('revisions','user','terms','photos','pandg','jobincludes','contacts.company','sections.properties','sections.options.properties','sections.options.tasks.materials','sections.options.tasks.properties','sections.options.materials','sections.options.system.tasks.properties','sections.options.system.photos','sections.options.system.labour','sections.options.notes','sections.options.nightshift.labours','sections.photos');
        $systems = System::with('terms','photos','tasks.materials','tasks.variables','tasks.properties','labour','guarantee')->get()->keyBy('id');
        $fuel = Fuel::whereDate('valid_from', '<=', Carbon::now())->where(function ($query) {
                $query->whereDate('valid_to', '>=', Carbon::now())
                      ->orWhere('valid_to', '=', null);
            })
            ->get();
        $fuel = $fuel->keyBy('type');
        $guarantees = Guarantee::all();
        $labour = Labour::all();
        
        $terms = Term::where('default',1)->get();
        $includes = JobInclude::all();
        $surveys = Survey::all();
        $basic_systems = $systems;
        $pandgs = Pandg::all();
        //$job->load('sections.options.materials.tasks');
        $users = User::all()->keyBy('id');
        //return $job['sections'];
        //
        //$systems->tasks->materials->groupBy('product_type');
        $job->revisions->transform(function($item){
            return $item->only(['id','created_at']);
        });
        $job->setRelation('revisions',$job->revisions->keyBy('id'));
        $systems = $systems->map(function($system){
            $system->setRelation('tasks',$system->tasks->keyBy('alias'));
            $system->tasks->map(function($task){
                $task->setRelation('materials', $task->materials->groupBy('product_type'));
                $task->materials->transform(function($matAlias){
                   return $matAlias->keyBy('id');
                });
                $task->setRelation('variables', $task->variables->groupBy(function($variable){
                    return Str::slug($variable->name);
                }));
                return $task;
            });
            return $system;
        });
        $jobSections = $job->sections->map(function($section){
            $newOptions = $section->options->map(function($option){
                $customTask = $option->tasks->filter(function($item){
                    return $item->alias == 'custom';
                })->first();
                if($customTask){
                    $option->system->tasks->push($customTask);
                }
                $newTasks = $option->system->tasks->keyBy('alias');
                $option->system->setRelation('tasks', $newTasks);
                //$option->union($option->pivot)
                return $option;
            });
            $section->setRelation('options', $newOptions);
            return $section;
        });
        $job->setRelation('sections', $jobSections);
        // foreach ($systems as $key => $item) {
        //     $modifiedtasks = [];
        //     foreach ($item['tasks'] as $taskKey => $task) {
        //         $modifiedtasks[$task['alias']] = $task;
        //         $modifiedMaterials = [];
        //         $modifiedVariables = [];
        //         foreach ($modifiedtasks[$task['alias']]['materials'] as $matkey => $mat) {
        //             $modifiedMaterials[$mat['product_type']][$mat['id']] = $mat;
        //         }
        //         foreach ($modifiedtasks[$task['alias']]['variables'] as $varKey => $var) {
        //             $slug = Str::slug($var['name']);
        //             $modifiedVariables[$slug][] = $var;
        //         }
        //         $modifiedtasks[$task['alias']]['materials'] = $modifiedMaterials;
        //         $modifiedtasks[$task['alias']]['variables'] = $modifiedVariables;
        //     }
        //     //sort by pivot order value
        //     uasort($modifiedtasks, function($a, $b) {
        //         return $a['pivot']['order'] - $b['pivot']['order'];
        //     });
        //     $systems[$key]['tasks'] = $modifiedtasks;
        // };
        //return $systems;
        // foreach ($job->photos as $photoKey => $photo) {
        //     $meta = json_decode($photo['meta']);
        //     if($meta->type==='main'){
        //         $job['mainPhoto']['id'] = $photo['id'];
        //         $job['mainPhoto']['photo'] = $photo['photo'];
        //         unset($job['photos'][$photoKey]);
        //     }
        // }
        // //return $job['images'];


        // foreach ($job['sections'] as $secKey => $section) {
        //     // $job['sections'][$secKey]['images'] = [];
        //     // if(!empty($section['photos'])){
        //     //     foreach ($section['photos'] as $photoKey => $photo) {
        //     //         $job['sections'][$secKey]['photos'][$photoKey]['meta'] = json_decode($photo['meta']);
        //     //         $job['sections'][$secKey]['images'][$job['sections'][$secKey]['photos'][$photoKey]['meta']->type]['id'] = $photo['id'];
        //     //         $job['sections'][$secKey]['images'][$job['sections'][$secKey]['photos'][$photoKey]['meta']->type]['photo'] = $photo['photo'];
        //     //     }
        //     // }else{
        //     //     $job['sections'][$secKey]['photos'] = [];
        //     // }
        //     foreach ($section['options'] as $optKey => $option) {

        //         foreach ($option['tasks'] as $tasKey => $task) {
        //             $reorderSystemTasks = false;
        //             if($task['alias']=='custom'){
        //                 $task['alias'] = strtolower('custom-'.str_replace(" ", "", $task['name']));
        //             }
        //             $task['order'] = $task['pivot']['order'];
        //             $task['days'] = $task['pivot']['days'];
        //             $task['total_labour'] = $task['pivot']['total_labour_price'];
        //             $task['total_supervisor'] = $task['pivot']['total_supervisor_price'];
        //             $task['total_materials'] = $task['pivot']['total_materials_price'];
        //             $task['total_cost_price'] = $task['pivot']['total_cost_price'];
        //             $task['system_id'] = $option['system_id'];
                    

        //             $newMaterials = [];
        //             foreach ($option['materials'] as $matKey => $material) {
        //                 if($material['pivot']['task']==$task['alias']){
        //                     $flag = $material['pivot']['cost_price']!=$material['cost_price'] ? true:false;
        //                     $areaconversion = false;
        //                     /*foreach ($material['tasks'] as $index => $matTask) {
        //                         if($matTask['id']==$task['id']){
        //                             $areaconversion = $matTask['pivot']['area'] ? $matTask['pivot']['area']:$areaconversion;
        //                         }
        //                     }*/
        //                     foreach ($systems[$option['system_id']]['tasks'] as $sysTaskKey=>$sysTask){
        //                         foreach ($sysTask['materials'] as $sysMatType => $sysMats) {
        //                             foreach ($sysMats as $sysMatId => $sysMat) {
        //                                 if($sysMatId==$material['id']){
        //                                     $areaconversion = $sysMat['pivot']['area'] ? $sysMat['pivot']['area']:$areaconversion;
        //                                 }
        //                             }
        //                         }
        //                     }
        //                     $newMaterials[] = [
        //                         'id' => $material['id'],
        //                         'name' => $material['name'],
        //                         'product_type' => $material['product_type'],
        //                         'coverage' => $material['coverage'],
        //                         'pack_size' => $material['pack_size'],
        //                         'cost_price' => $material['cost_price'],
        //                         'qty' => $material['pivot']['qty'],
        //                         'price' => $material['pivot']['price'],
        //                         'stock' => $material['stock'],
        //                         'unit_of_measure' => $material['unit_of_measure'],
        //                         'task' => $task['alias'],
        //                         'areaconversion' => $areaconversion,
        //                         'flag'=> $flag
        //                     ];
        //                 }
        //             }
        //             $task['materials'] = $newMaterials;
        //             $job['sections'][$secKey]['options'][$optKey]['tasks'][$tasKey] = $task;
                   

        //             //If a custom task exists add it to the system tasks
        //             if(!isset($systems[$job['sections'][$secKey]['options'][$optKey]['system']['id']]['tasks'][$task['alias']])){
        //                 $reorderSystemTasks = true;
        //                 $systems[$option['system_id']]['tasks'][$task['alias']] = $task;
        //             }
        //             //Ensure order of system tasks matched option tasks
        //             $systems[$option['system_id']]['tasks'][$task['alias']]['pivot']['order'] = $task['order'];

        //             $job['sections'][$secKey]['options'][$optKey]['system']['tasks'][$task['alias']] = $task;
        //             unset($job['sections'][$secKey]['options'][$optKey]['system']['tasks'][$tasKey]);

        //             if($reorderSystemTasks){
        //                 uasort($systems[$option['system_id']]['tasks'], function($a, $b) {
        //                     return $a['pivot']['order'] - $b['pivot']['order'];
        //                 });
        //             }
        //         }
        //         $job['sections'][$secKey]['options'][$optKey]['show'] = false;
        //     }
        //     $job['sections'][$secKey]['show'] = false;
        // }

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
        //dd($request->all());
        $job->load('photos');
        $requestData = json_decode($request->data,true);
        
        // if($request->input('_santoken')){
        //     $job->sections->delete();
        //     foreach ($job->sections as $section) {
        //         $section->delete();
        //     }
        // }
        
        $jobValue = 0;
        foreach ($requestData['sections'] as $secKey => $sec) {
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

            foreach ($section->photos as $photo) {
                Storage::disk('public')->delete($photo->photo);
            }
            $section->photos()->delete();
            if($request->has('sectionPhotos')){
                foreach ($request->sectionPhotos as $photKey => $photo) {
                    if($photo!=''){
                        $filepath = $photo->store($job->id, 'public');
                        $section->photos()->create(['photo'=>$filepath, 'type'=>'section']);
                    }
                }
            }

            //properties
            if(!empty($sec['properties'])){
                $syncProperties = [];
                foreach ($sec['properties'] as $property) {
                    if($property['value']){
                        $syncProperties[$property['id']]=[
                            'value' => $property['value']
                        ];
                    }
                }
                $section->properties()->sync($syncProperties);
                $syncProperties = [];
            }

            //options
            $maxSellingPrice = 0;
            foreach ($sec['options'] as $optKey => $opt) {
                //system
                //$system = System::with('tasks')->findOrFail($opt['system_id']);

                //option
                $newOption = [
                    'name'  => $opt['name'],
                    'system_id'  => $opt['system_id'],
                    'description' => $opt['description'],
                    'total_labour' => $opt['total_labour'],
                    'total_supervisor' => $opt['total_supervisor'],
                    'days' => $opt['days'],
                    'total_materials' => $opt['total_materials'],
                    'total_cost_price' => $opt['total_cost_price'],
                    'total_selling_price' => $opt['total_selling_price'],
                    'markup' => $opt['markup'],
                    //parameters
                    // 'area'=>isset($opt['area']) ? $opt['area'] : null,
                    // 'perimeter'=>isset($opt['perimeter']) ? $opt['perimeter'] : null,
                    // 'difficulty'=>isset($opt['difficulty']) ? $opt['difficulty'] : null,
                    // 'pitch'=>isset($opt['pitch']) ? $opt['pitch'] : null,
                    // 'volume'=>isset($opt['volume']) ? $opt['volume'] : null,
                    // 'length'=>isset($opt['length']) ? $opt['length'] : null,
                    // 'width'=>isset($opt['width']) ? $opt['width'] : null,
                    // 'height'=>isset($opt['height']) ?$opt['height'] : null,
                    // 'crosslaps'=> isset($opt['crosslaps']) ? $opt['crosslaps'] : null,
                    // 'ridge'=> isset($opt['ridge']) ? $opt['ridge'] : null,
                    // 'sidewall'=> isset($opt['sidewall']) ? $opt['sidewall'] : null,
                    // 'valleys'=> isset($opt['valleys']) ? $opt['valleys'] : null,
                    // 'honeycomb'=> isset($opt['honeycomb']) ? $opt['honeycomb'] : null,
                    // 'tieholes'=> isset($opt['tieholes']) ? $opt['tieholes'] : null,
                    // 'crack'=> isset($opt['crack']) ? $opt['crack'] : null,
                    // 'plug'=> isset($opt['plug']) ? $opt['plug'] : null,
                ];
                $maxSellingPrice = $newOption['total_selling_price']>$maxSellingPrice ? $newOption['total_selling_price']:$maxSellingPrice;

                $option = isset($opt['id']) ? Option::find($opt['id']) : false;
                if(!$option){
                    $option = $section->options()->create($newOption);
                }else{
                    $option->update($newOption);
                }

                //properties
                if(!empty($opt['properties'])){
                    $syncProperties = [];
                    foreach ($opt['properties'] as $property) {
                        if($property['value']!='0' && $property['value']!=0){
                            $syncProperties[$property['id']]=[
                                'value' => $property['value']
                            ];
                        }
                    }
                    $option->properties()->sync($syncProperties);
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

                //Nightshifts
                if($option->nightshift){
                    $option->nightshift->delete();                    
                }
                if(isset($opt['nightshift']) && $opt['nightshift']['nights']){
                    $nightshift = new Nightshift(['nights' => $opt['nightshift']['nights']]);
                    $option->nightshift()->save($nightshift);
                    $nightshiftLabours = collect($opt['nightshift']['labours'])->mapWithKeys(function($item){
                        return [$item['id'] => ['qty'=>$item['qty']]];
                    })->toArray();
                    $option->fresh()->nightshift->labours()->sync($nightshiftLabours);
                }

                if(!empty($opt['tasks'])){
                    $syncTasks = [];
                    foreach ($opt['tasks'] as $taskKey => $task) {
                        //dd($task);
                        //$variable = null;
                        // if(isset($task['variables']) && count($task['variables'])>0){
                        //     foreach ($task['variables'] as $typeKey => $type) {
                        //         foreach ($type as $varKey => $var) {
                        //             if($var!=''){
                        //                 $variable = $var;
                        //             }
                        //         }
                        //     }
                        // }
                        
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
                            if(!empty($task['materials'])){
                                $syncCusMaterials = [];
                                foreach ($task['materials'] as $matType => $materials) {
                                    foreach ($materials as $cusMaterial) {
                                        $newMaterial = [
                                            'name'=> $cusMaterial['name'],
                                            'pack_size'=> $cusMaterial['pack_size'],
                                            'cost_price'=> $cusMaterial['cost_price'],
                                            'unit_of_measure'=> $cusMaterial['unit_of_measure'],
                                            'product_type'=> $matType,
                                            'coverage'=> $cusMaterial['coverage']
                                        ];
                                        $matModel = Material::create($newMaterial);
                                        foreach ($opt['materials'] as $key => $optMaterial) {
                                            if($optMaterial['product_type'] == matType && $optMaterial['task'] == $task['alias']){
                                                $optMaterial['id'] = $matModel->id;
                                            }
                                        }
                                        $syncCusMaterials[] = $matModel->id;                                        
                                    }
                                }
                                if(!empty($syncCusMaterials)){
                                    $taskModel->materials()->sync($syncCusMaterials);
                                }
                            }
                            if(!empty($task['properties'])){
                                $syncCusProperties = [];
                                foreach ($task['properties'] as $property) {
                                    $syncCusProperties[] = $property['id'];    
                                }
                                if(!empty($syncCusProperties)){
                                    $taskModel->properties()->sync($syncCusProperties);
                                }
                            }
                            // if(!empty($opt['materials'][$taskKey])){
                            //     $syncCusMaterials = [];
                            //     foreach ($opt['materials'][$taskKey] as $cusKey => $cusMaterial) {
                            //         $newMaterial = [
                            //             'name'=> $cusMaterial['name'],
                            //             'pack_size'=> $cusMaterial['pack_size'],
                            //             'cost_price'=> $cusMaterial['cost_price'],
                            //             'unit_of_measure'=> $cusMaterial['unit_of_measure'],
                            //             'product_type'=> $cusKey,
                            //             'coverage'=> $cusMaterial['coverage']
                            //         ];
                            //         $matModel = Material::create($newMaterial);
                            //         $opt['materials'][$taskKey][$cusKey]['id'] = $matModel->id;
                            //         $syncCusMaterials[] = $matModel->id;
                            //     }
                            //     if(!empty($syncCusMaterials)){
                            //         $taskModel->materials()->sync($syncCusMaterials);
                            //     }
                            // }
                        }
                        $syncTasks[$task['id']] = [
                            'order' => $task['pivot']['order'],
                            'days' => $task['pivot']['days'],
                            'difficulty' => isset($task['pivot']['difficulty']) ? $task['pivot']['difficulty'] : null,
                            'total_labour_price' => isset($task['pivot']['total_labour_price']) ? $task['pivot']['total_labour_price'] : null,
                            'total_materials_price' => isset($task['pivot']['total_materials_price']) ? $task['pivot']['total_materials_price'] : null,
                            'total_supervisor_price' => isset($task['pivot']['total_supervisor_price']) ? $task['pivot']['total_supervisor_price'] : null,
                            'total' => $task['pivot']['total_cost_price'],
                            'variable_id' => isset($task['variable_id']) ? $task['variable_id'] : null,
                            'property_value' => isset($task['pivot']['property_value']) ? $task['pivot']['property_value'] : null,
                        ];
                    }
                    $option->tasks()->sync($syncTasks);
                }

                if(!empty($opt['materials'])){
                    $syncMaterials = [];
                    foreach ($opt['materials'] as $material) {
                        if($material['qty']!='0' && $material['qty']!=0){
                            $syncMaterials[$material['id']]=[
                                'qty' => $material['qty'],
                                'price' => $material['price'],
                                'cost_price' => $material['cost_price'],
                                'product_type' => $material['product_type'],
                                'task' => $material['task'],
                            ];
                        }
                    }
                    $option->materials()->sync($syncMaterials);
                }
            }
            $jobValue += $maxSellingPrice;
        }
        //return to jobs
        //return 'YAY!'
        //
        foreach ($job->photos as $photo) {
            Storage::disk('public')->delete($photo->photo);
        }
        $job->photos()->delete();

        if($request->hasFile('mainPhoto')){
            $filepath = $request->file('mainPhoto')->store($job->id, 'public');
            $job->photos()->create(['photo'=>$filepath, 'type'=>'main', 'properties'=>$request->mainPhotoSnapShot]);
        }
        if($request->hasFile('mainPhotoEdited')){
            $filepath = $request->file('mainPhotoEdited')->store($job->id, 'public');
            $job->photos()->create(['photo'=>$filepath, 'type'=>'edited']);
        }

        if($request->has('photos')){
            foreach ($request['photos'] as $photo) {
                $filepath = $photo->store($job->id, 'public');
                $job->photos()->create(['photo'=>$filepath, 'type'=>'photo']);                
            }
        }

        if(!empty($requestData['jobpsandgs'])){
            foreach ($requestData['jobpsandgs'] as $pandgKey => $pandg) {
                if($pandg){
                    $details = [
                        'name'=>$pandg['name'],
                        'description'=>isset($pandg['description']) ? $pandg['description']:null,
                        'pandg_category_id'=>1,
                        'job_id'=>$job->id,
                        'rate'=>$pandg['rate'],
                        'qty'=>$pandg['qty'],
                        'period'=>isset($pandg['period']) ? $pandg['period']:'fixed',
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
        }else{
            $job->pandg->each(function($item){$item->delete();});
        }
        if(!empty($requestData['jobterms'])){
            $syncTerms = [];
            foreach ($requestData['jobterms'] as $term) {
                if($term['checked']){
                    $syncTerms[] = $term['id'];
                }
            }
            $job->terms()->sync($syncTerms);
        }
        if(!empty($requestData['jobincludes'])){
            $syncIncludes = [];
            foreach ($requestData['jobincludes'] as $include) {
                if($include['checked']){
                    $syncIncludes[] = $include['id'];
                }
            }
            $job->jobincludes()->sync($syncIncludes);
        }
        $newEvent = $job->status=='build' ? true:false;
        $job->status = 'pending';
        $job->user_id = $requestData['user']['id'];
        $job->value = $jobValue;
        $job->title1 = $requestData['title1'];
        $job->title2 = $requestData['title2'];
        $job->title = $requestData['title'];
        $job->save();
        $requestHtml = $requestData['proposalHtml'];
        Browsershot::html($requestHtml)->margins(0,0,0,0)->format('A4')->showBackground()->savePdf(storage_path('app/public/'.$job->id.'/'.$job->order_number.'-'.$job->name.'.pdf'));
        if(!isset($requestData['_santoken'])){
            //add Revision
            unset($requestData['proposalHtml']);
            $revision = new Revision(['data'=>json_encode($requestData)]);
            $job->revisions()->save($revision);
        }
        //Trait GeneratePDF
        return $requestHtml;
        // dd();
        //$this->WKtoHTML($requestData['html'],$job->order_number.'-'.$job->name.'.pdf',$job->order_number,'save');

        // $user = User::find($requestData['user_id']);
        // if($newEvent){
        //     Event::fire(new JobWasCreated($job,$user->insightly_id));
        // }else{
        //     Event::fire(new JobWasUpdated($job,$user->insightly_id));
        // }
        //return 'YAY '/*.$user->insightly_id*/;
        
        return redirect('/');
    }

    private function generateOrderNumber(){
        $maxId = DB::table('jobs')->max('id');
        $orderNum = "SAN".sprintf('%04d', $maxId+1)."-".date("y");
        return $orderNum;
    }
}
