<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('register/user', 'API\UserController@registerUser');
Route::post('forgot', 'API\UserController@forgot_pass');
Route::get('get_all_hospitals', 'API\UserController@get_all_hospitals');
Route::post('get_all_dept', 'API\UserController@get_all_dept');
Route::post('get_all_grades', 'API\UserController@get_all_grades');
Route::post('update_pass', 'API\UserController@update_pass');
Route::group(['middleware' => 'auth:api'], function(){

    Route::post('details', 'API\UserController@details');
    Route::post('experience', 'API\UserController@storeExperience');
    Route::put('update/profile/{id}', 'API\UserController@updateProfile');
    Route::post('job/detail', 'API\UserController@jobDetail');
    Route::post('job/application', 'API\UserController@jobApplication');
    Route::post('job/listing', 'API\UserController@jobListing');


    Route::post('get_doc_experience', 'API\UserController@get_doc_experience');

    Route::post('submit_time_sheet', 'API\UserController@submit_time_sheet');
    Route::post('reject_job', 'API\UserController@reject_job');
    Route::post('save_prefs', 'API\UserController@save_prefs');
    Route::post('get_doc_prefs', 'API\UserController@get_doc_prefs');
    Route::post('reset_pass', 'API\UserController@reset_pass');
    Route::post('doctor_status', 'API\UserController@doctor_status');
    Route::post('update_profile', 'API\UserController@update_profile');
    Route::post('job/cancel', 'API\UserController@cancelJob');

    Route::post('completed', 'API\UserController@completedJobs');
    Route::post('hired', 'API\UserController@hiredJobs');
    Route::post('save_settings', 'API\UserController@save_settings');
    Route::post('hire_detail', 'API\UserController@hiredDetail');
    Route::post('history', 'API\UserController@history');

    Route::post('payment', 'API\UserController@paymentStatus');
    Route::post('logout', 'API\UserController@logout');
    Route::post('calendar', 'API\UserController@myCalendar');
    Route::post('get_profile', 'API\UserController@get_doc_profile');


});
