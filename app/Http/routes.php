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
use App\Company;
use App\Contacts;
use App\Jobs;
use App\Materials;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
		return App\Jobs::with('revisions','user','terms','photos','pandg','contacts.company','sections.options.tasks.materials','sections.options.materials','sections.options.system.photos','sections.options','sections.options.notes','sections.photos')->findOrFail($value);
	});
	Route::group(['prefix' => 'jobs'], function(){
		Route::get('/', ['uses' => 'JobController@showJobs']);
		Route::get('/insightly', ['uses' => 'JobController@testInsightly']);
		Route::get('/new', ['uses' => 'JobController@createJob']);
		Route::post('/', ['uses' => 'JobController@saveJob']);
		Route::get('/{id}/edit', ['uses' => 'JobController@editJob']);
		Route::post('/{id}', ['uses' => 'JobController@updateJob']);
		Route::get('/{job}/build', ['uses' => 'JobController@showBuildJob']);
		Route::post('/{job}/build', ['uses' => 'JobController@saveBuildJob']);

		Route::get('/{job}/supply', ['uses' => 'JobController@showSupplyJob']);
		Route::post('/{job}/supply', ['uses' => 'JobController@saveSupplyJob']);

		Route::get('/current', ['uses' => 'JobController@showCurrentJobs']);
		Route::get('/current/{jobid}', ['uses' => 'JobController@editCurrentJob']);

		Route::get('/revision/{revisionid}', function(Request $request, $id)
		{

			$revision = App\Revision::findOrfail($id);

			$result = $revision ? 'success':'error';

			$data = [
			'result'=>$result
			];
			$revisionData = unserialize($revision->data);
			Input::merge($revisionData);
			$new_request = Request::create( '/jobs/'.$revision->job_id.'/build', 'POST');
			$response = Route::dispatch( $new_request );

			return $revisionData;
		});
	});

	Route::group(['prefix'=>'orders'], function(){
		Route::get('/', ['uses' => 'OrderController@showOrders']);
		Route::post('/', ['uses' => 'OrderController@saveOrder']);
	});

	Route::group(['prefix'=>'pdf'], function() {
		Route::post('/', ['uses' => 'ProposalController@WKtoHTML']);
	});

	Route::get('/sanikakryton', function(){
		return File::get(public_path() . '/sanikakryton/index.html');
	});

//////////////////////////////////////////////////////
//API ROUTES
//////////////////////////////////////////////////////
	Route::group(['prefix'=>'api'],function(){

		//Get Companys
		Route::get('company', function(Request $request)
		{
			$name = $request->input('name');
			$company = Company::where('name', 'LIKE', '%'.$name.'%')->with('contacts')->get();
			return $company;
		});

		//Get Job
		Route::get('job', function(Request $request)
		{
			$id = $request->input('id');
			$job = App\Jobs::with('order','sections.options','contacts.company')->find($id);

			$result = $job ? 'success':'error';

			$data = [
			'result'=>$result,
			'job'=>$job
			];
			return $data;
		});
		//Delete Job
		Route::post('job/delete', function(Request $request)
		{
			$id = $request->input('id');
			$deleted = App\Jobs::destroy($id);

			$result = $deleted ? 'success':'error';

			$data = [
				'result'=>$result
			];
			return $data;
		});
		//Get Revision
		Route::get('/revision/{revisionid}', function(Request $request, $id)
		{

			$revision = App\Revision::findOrfail($id);

			$revisionData = unserialize($revision->data);
			$revisionData['_token'] = $request->header('X-CSRF-TOKEN');
			$santoken = bin2hex(random_bytes(33));
			session(['santoken'=>$santoken]);
			$revisionData['_santoken'] = $santoken;

			//return $revisionData;

			$client = new \GuzzleHttp\Client(['base_uri' => 'http://sanqcorp.app/api/job/update/']);
			try {
				$request = $client->request('POST', $revisionData['job_id'], [
					'json' => $revisionData
					]);
				$code = $request->getStatusCode();
				$reason = $request->getReasonPhrase();
				$body = $request->getBody();

				$data=[
				'result'=>'success'
				];

				return json_decode((string) $body, true);

			} catch (\GuzzleHttp\Exception\RequestException $e) {
				echo "Shite";
				echo \GuzzleHttp\Psr7\str($e->getRequest());
				if ($e->hasResponse()) {
					echo \GuzzleHttp\Psr7\str($e->getResponse());
				}
			}
		});
		//job Job from Revision
		Route::post('/job/update/{job}', ['uses' => 'JobController@saveBuildJob']);

		//Get Materials
		Route::get('materials', function(Request $request)
		{
			//return Materials::all();
			$name = null !== $request->input('name') ? $request->input('name'):'';
			$materials = Materials::where('name', 'LIKE', '%'.$name.'%')
			->orWhere(function($query) use( &$name)
			{
				$query->where('product_type', 'LIKE', '%'.$name.'%');
			})
			->get();
			return $materials;
		});

		//Get Contacts
		Route::get('contacts', function(Request $request)
		{
			$id = $request->input('id');
			if($id){
				$contact = Contacts::find($id);
				return $contact;
			}else{
				$name = $request->input('name');
				$company_id = $request->input('company_id') ? $request->input('company_id'):'*';

				$contacts = Contacts::where([
					['first_name', 'LIKE', '%'.$name.'%'],
					['company_id','LIKE',$company_id]
					])
				->orWhere([
					['last_name', 'LIKE', '%'.$name.'%'],
					['company_id','LIKE',$company_id]
					])
				->get();
				$contacts_new = [];
				foreach ($contacts as $contact) {
					$contacts_new[] =[
					'id'=>$contact->id,
					'name'=>$contact->first_name." ".$contact->last_name,
					'company'=>$contact->company->name,
					'company_id'=>$contact->company->id,
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
				return $contacts_new;
			}
		});

		Route::post('uploadproposalimage', function(Request $request){
			$result = 'fail';
			$filename = NULL;
			if($request->hasFile('file')){
				$file = $request->file('file');
				$ref = $request->input('ref');
				$sizex = $request->input('sizex');
				$sizey = $request->input('sizey');
				$filename = strtolower(str_replace(" ", "", $file->getClientOriginalName()));
				$filePath = public_path().'/job/'.$ref.'/img/';
				if(!file_exists($filePath)){
					if (!mkdir($filePath, 0775, true)) {
						dd('Failed to create folders...');
					}
				}
				Image::make($file)->fit($sizex, $sizey)->save($filePath.'/'.$filename);

				//$file->move(public_path().'/job/'.$ref.'/img/'.'/', );
				$result = 'success';
			}
			$data = [
			'result'=>$result,
			'filename'=>$filename
			];
			return $data;
		});

		Route::post('saveimage', function(Request $request){
			$result = 'fail';
			$filename = NULL;
			$ref = $request->input('ref');
			$file = $request->input('img');
			$type = $request->input('type');
			if($type=='main'){
				$filePath = public_path().'/job/'.$ref.'/img/';
				if(!file_exists($filePath)){
					if (!mkdir($filePath, 0775, true)) {
						dd('Failed to create folders...');
					}
				}
				Image::make($file)->fit(640, 480)->save($filePath.'/main_diagram.png');
				$filename = 'main_diagram.png';
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
