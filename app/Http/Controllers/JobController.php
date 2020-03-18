<?php

namespace App\Http\Controllers;

use App\Company;
use App\Contact;
use App\File;
use App\Http\Controllers\Traits\GeneratePdfTrait;
use App\Http\Requests\AddJobRequest;
use App\Job;
use App\Providers\JobWasCreated;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Inertia\Inertia;

class JobController extends Controller
{
    use GeneratePdfTrait;

    public function index()
    {
        $jobs = Job::with('contacts.company', 'sections.options')->get();

        $vueJob = [];
        foreach ($jobs as $key => $job) {
            $vueJob[$job->id] = [
                'key'=> $key,
                'show'=> false,
                'sections'=>count($job->sections),
            ];
        }
        //return $vueJob;
        // JavaScript::put([
        //     'jobs' => $vueJob
        // ]);

        return Inertia::render('Jobs/Index', compact('jobs'));

        //return view('jobs.index', compact(['jobs','file']));
    }

    public function create(Request $request)
    {
        JavaScript::put([
            'old' => $request->old(),
            'users' => $users = User::all()->keyBy('id'),
        ]);

        return view('jobs.create');
    }

    public function store(AddJobRequest $request)
    {
        //return $request->all();
        //return $this->generateOrderNumber();

        $company_id = $request->input('company_id');
        $new_contacts = [];

        if (! $company_id) {
            //return $request->all();
            $company = Company::create([
                'name'=>$request->input('company_name'),
                'address1'=>$request->input('company_address1'),
                'address2'=>$request->input('company_address2'),
                'address3'=>$request->input('company_address3'),
                'post_code'=>$request->input('company_post_code'),
                'vat'=>$request->input('company_vat'),
            ]);
            $company_id = $company->id;
        }

        if (! empty($request->input('new_contact'))) {
            foreach ($request->input('new_contact') as $new_contact) {
                if ($new_contact['first_name'] !== '' && $new_contact['last_name'] !== '') {
                    $contact = Contact::create([
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
                        'email'=>$new_contact['email'],
                    ]);
                    $new_contacts[] = $contact->id;
                }
            }
        }
        $distance = explode(' ', $request->input('distance'));
        $contacts = [];

        if ($request->input('contact')) {
            foreach ($request->input('contact') as $key => $contact) {
                if (isset($contact['id'])) {
                    $contacts[] = $contact['id'];
                }
            }
        }

        $job_contacts = array_merge($contacts, $new_contacts);
        //return $job_contacts;

        $job = Job::create([
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
            'country'=>$request->input('country'),
            'template'=>$request->input('supply') ? 'supply' : 'service',
        ]);

        $job->contacts()->sync($job_contacts);

        //check for custom job
        if ($request->input('custom')) {
            $job->value = $request->input('value');
            $job->user_id = $request->input('user_id');
            $job->status = 'pending';
            $job->custom = true;
            $job->save();
            //upload file
            if ($request->file('quote')->isValid()) {
                $quote = $request->file('quote');
                $filePath = public_path().'/job/'.$job->order_number.'/';
                if (! file_exists($filePath)) {
                    if (! mkdir($filePath, 0775, true)) {
                        abort('Failed to create folders, contact Roark');
                    }
                }
                $newname = $job->order_number.'-'.$job->name.'.'.$quote->getClientOriginalExtension();
                $quote->move($filePath, $newname);

                $meta = [];
                $meta['fileType'] = $quote->getClientOriginalExtension();
                $meta['path'] = $filePath;
                $meta['type'] = 'quote';

                $quoteDoc = new File([
                    'name' => $newname,
                    'meta' => json_encode($meta),
                ]);

                $job->files()->save($quoteDoc);
            }
            $user = User::find($job->user_id);
            Event::fire(new JobWasCreated($job, $user->insightly_id));
        }
        //return "Success";
        return redirect('/jobs/'.$job->id.'/build');
    }
}
