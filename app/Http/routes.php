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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('bucket', 'BucketController', ['only' => [
    'index', 'store', 'show', 'edit'
]]);
Route::get('/testsms', function(){
	// $sms = new Artistan\Nexmo\Service\Message\Sms;
	// //$sms->sendText('27712871097','27877460123','dude, this is from a laravel package');
	// return($sms->sendText('27712871097','27877460123','dude, this is from a laravel package'));

	$bulkSms = new anlutro\BulkSms\BulkSmsService('roark', 's4n1k@WP', 'https://bulksms.2way.co.za');
	return($bulkSms->sendMessage('+27712871097', 'Hello there!'));
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
    //
});
