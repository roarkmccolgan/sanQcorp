<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\User;
use App\Company;
use App\Contacts;
use Illuminate\Http\Request;

Route::resource('bucket', 'BucketController', ['only' => [
    'index', 'store', 'edit'
]]);
Route::get('/bucket/smscommand', 'BucketController@smsCommand');

Route::get('/testsms', function(){
	// $sms = new Artistan\Nexmo\Service\Message\Sms;
	// //$sms->sendText('27712871097','27877460123','dude, this is from a laravel package');
	// return($sms->sendText('27712871097','27877460123','dude, this is from a laravel package'));

	$bulkSms = new anlutro\BulkSms\BulkSmsService('roark', 's4n1k@WP', 'https://bulksms.2way.co.za');
	return($bulkSms->sendMessage('+27712871097', 'A free character counter tool provides instant character count statistics for a given text. The tool reports the number of character with spaces and without spaces, also the number of words and sentences. Character Count Tool monitors and reports the character counts of the text that you type in real time. Thus it is h'));
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');

    //jobs
    Route::bind('job', function ($value) {
        return App\Jobs::with('contacts.company','sections.options.tasks.materials','sections.options.materials','sections.options.system')->findOrFail($value);
    });
    Route::group(['prefix' => 'jobs'], function(){
        Route::get('/', ['uses' => 'JobController@showJobs']);
        Route::get('/new', ['uses' => 'JobController@createJob']);
        Route::post('/', ['uses' => 'JobController@saveJob']);
        Route::get('/{id}/edit', ['uses' => 'JobController@editJob']);
        Route::post('/{id}', ['uses' => 'JobController@updateJob']);
        Route::get('/{job}/build', ['uses' => 'JobController@showBuildJob']);
    	Route::post('/{job}/build', ['uses' => 'JobController@saveBuildJob']);

        Route::get('/current', ['uses' => 'JobController@showCurrentJobs']);
        Route::get('/current/{jobid}', ['uses' => 'JobController@editCurrentJob']);
    });

    Route::group(['prefix'=>'pdf'], function() {
        Route::post('/', ['uses' => 'ProposalController@WKtoHTML']);
    });

    Route::get('/sanikakryton', function(){
        return File::get(public_path() . '/sanikakryton/index.html');
    });


    //API ROUTES
    Route::group(['prefix'=>'api'],function(){

        //Get Companys
        Route::get('company', function(Request $request)
        {
            $name = $request->input('name');
            $company = Company::where('name', 'LIKE', '%'.$name.'%')->with('contacts')->get();
            return $company;
        });

        //Get Contacts
        Route::get('privatecontacts', function(Request $request)
        {
            $name = $request->input('name');
            $contacts = Contacts::where('first_name', 'LIKE', '%'.$name.'%')
                                ->orWhere(function($query) use( &$name)
                                {
                                    $query->where('last_name', 'LIKE', '%'.$name.'%');
                                })
                                ->with('company')
                                ->get();
            $contacts_new = [];
            foreach ($contacts as $contact) {
                if($contact->company->name=='Private'){
                    $contacts_new[] =[
                        'id'=>$contact->id,
                        'name'=>$contact->first_name." ".$contact->last_name,
                        'description'=>$contact->company->name,
                        'first_name'=>$contact->first_name,
                        'last_name'=>$contact->last_name,
                        'job_title'=>$contact->job_title,
                        'department'=>$contact->department,
                        'send_invoice'=>$contact->send_invoice,
                        'region'=>$contact->region,
                        'country'=>$contact->country,
                        'contact1'=>$contact->contact1,
                        'contact2'=>$contact->contact2,
                        'contact3'=>$contact->contact3,
                        'email'=>$contact->email,
                    ];
                }
            }
            return $contacts_new;
        });

        Route::post('uploadproposalimage', function(Request $request){
            $result = 'fail';
            $filename = NULL;
            if($request->hasFile('file')){
                $file = $request->file('file');
                $ref = $request->input('ref');
                $filename = strtolower(str_replace(" ", "", $file->getClientOriginalName()));
                Image::make($file)->fit(640, 480)->save(public_path().'/img/proposal/'.$ref.'/'.$filename);

                //$file->move(public_path().'/img/proposal/'.$ref.'/', );
                $result = 'success';
            }
            $data = [
                'result'=>$result,
                'filename'=>$filename
            ];
            return $data;
        });
    });

});
