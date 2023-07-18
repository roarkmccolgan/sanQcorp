<?php

use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Route::get('login')->name('login')->uses('Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login')->name('login.attempt')->uses('Auth\LoginController@login')->middleware('guest');
Route::post('logout')->name('logout')->uses('Auth\LoginController@logout');

// Dashboard
Route::get('/')->name('dashboard')->uses('DashboardController')->middleware('auth');

Route::prefix('jobs')->group(function () {
    Route::get('/')->name('jobs')->uses('JobController@index')->middleware('auth');
    Route::get('/{job}/details')->name('jobs.details.create')->uses('JobDetailController@create')->middleware('auth');
    Route::post('/{job}/details')->name('jobs.details.store')->uses('JobDetailController@store')->middleware('auth');
});

Route::get('/materials', 'MaterialController@index')->middleware('auth');

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});
