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

    Route::group(['prefix' => 'jobs'], function(){
        Route::get('/', ['uses' => 'JobController@showJobs']);
        Route::get('/newjob', ['uses' => 'JobController@createJob']);
    	Route::post('/newjob', ['uses' => 'JobController@saveJob']);
    });

    //API ROUTES
    Route::group(['prefix'=>'api'],function(){

        //Get Contacts
        Route::get('contacts', function(Request $request)
        {
            $name = $request->input('name');
            $contacts = Contacts::where('first_name', 'LIKE', '%'.$name.'%')->with('company')->get();
            return $contacts;
        });

    });

});
