<?php

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
Route::get('cache', function () {

    /* php artisan migrate */
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear');
    dd("Done");
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    dd("Done");
});
Route::get('pass', function () {

    /* php artisan migrate */
//    \Artisan::call('passport:install');
    dd(\Artisan::call());
});


 Route::get('/', function () { return redirect('/admin/home'); });
Auth::routes();
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', 'HomeController@index');
    Route::resource('/','EventController');
    Route::get('/home', 'HomeController@index')->name('home');
    // Route Resource for hospial
    Route::resource('hospital', 'Admin\HospitalController');

    Route::resource('grades', 'Admin\GradeController');
    // Route Resource for departments
    Route::resource('departments', 'Admin\DepartmentsController');

//    Route::get('timesheet/change_status/{timesheet_id}/{status}', ['uses' => 'Admin\TimesheetController@change_status', 'as' => 'timesheet.change_status']);
    Route::get('timesheet/change_status/{job_id}/{status}', ['uses' => 'Admin\TimesheetController@change_status', 'as' => 'timesheet.change_status']);
    Route::resource('timesheet', 'Admin\TimesheetController');
 


    Route::get('application/change_status/{application_id}/{status}', ['uses' => 'Admin\ApplicationController@change_status', 'as' => 'application.change_status']);
    Route::resource('application', 'Admin\ApplicationController');
    Route::get('cancelled', ['uses' => 'Admin\ApplicationController@cancelled', 'as' => 'job.cancelled']);


    Route::get('archived', ['uses' => 'Admin\JobController@archived', 'as' => 'job.archived']);
    Route::get('completed', ['uses' => 'Admin\JobController@completed', 'as' => 'job.completed']);
    
    Route::post('schoolfilter', ['uses' => 'Admin\JobController@Schoolfilter', 'as' => 'job.Schoolfilter']);
    Route::post('adminfilter', ['uses' => 'Admin\JobController@adminfilter', 'as' => 'job.adminfilter']);
    Route::get('hired', ['uses' => 'Admin\JobController@hired_jobs', 'as' => 'job.hired']);
    Route::get('savejobs', ['uses' => 'Admin\JobController@save_jobs', 'as' => 'job.save_jobs']);

    Route::get('job/{id}/repost', ['uses' => 'Admin\JobController@repost', 'as' => 'job.repost']);
    Route::get('job/get_job_grades/{id}', ['uses' => 'Admin\JobController@get_job_grades', 'as' => 'job.get_job_grades']);
    Route::get('job/change_status/{job_id}/{status}', ['uses' => 'Admin\JobController@change_status', 'as' => 'job.change_status']);
    Route::get('job/job_status/{job_id}/{status}', ['uses' => 'Admin\JobController@job_status', 'as' => 'job.job_status']);
    Route::get('job/save_status/{job_id}', ['uses' => 'Admin\JobController@save_status', 'as' => 'job.save_status']);
    Route::resource('job', 'Admin\JobController');
    Route::resource('shift_management', 'Admin\ShiftManagementController');



    Route::patch('permissions/active/{id}', ['uses' => 'Admin\PermissionsController@active', 'as' => 'permissions.active']);
    Route::patch('permissions/inactive/{id}', ['uses' => 'Admin\PermissionsController@inactive', 'as' => 'permissions.inactive']);
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);

    Route::patch('roles/active/{id}', ['uses' => 'Admin\RolesController@active', 'as' => 'roles.active']);
    Route::patch('roles/inactive/{id}', ['uses' => 'Admin\RolesController@inactive', 'as' => 'roles.inactive']);
    Route::resource('roles', 'Admin\RolesController');

    Route::resource('users', 'Admin\UsersController');
    Route::get('doctors', ['uses' => 'Admin\UsersController@doctors', 'as' => 'users.doctors']);
    Route::get('new', ['uses' => 'Admin\UsersController@newDoctors', 'as' => 'users.new']);
    Route::get('change_doc_status/{id}/{status}', ['uses' => 'Admin\UsersController@change_doc_status', 'as' => 'users.change_doc_status']);

    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    Route::post('users/get_dept_data', ['uses' => 'Admin\UsersController@get_dept_data', 'as' => 'users.get_dept_data']);


    Route::patch('unittype/active/{id}', ['uses' => 'Admin\UnittypeController@active', 'as' => 'unittype.active']);
    Route::patch('unittype/inactive/{id}', ['uses' => 'Admin\UnittypeController@inactive', 'as' => 'unittype.inactive']);
    Route::resource('unittype', 'Admin\unittypeController');

   

    //Settings Resrouce Starts Here
    Route::resource('settings', 'Admin\SettingsController');
    //Settings Resrouce Ends Here
 // Project Resrouce Starts Here

 // Project Resrouce Starts Here
    Route::get('projects/show/{id}', ['uses' => 'Admin\ProjectController@show', 'as' => 'projects.show']);
    Route::post('projects/export/data', ['uses' => 'Admin\ProjectController@export', 'as' => 'projects.export']);
    Route::post('projects/changeListingMode', ['uses' => 'Admin\ProjectController@changeListingMode', 'as' => 'projects.changeListingMode']);
    Route::patch('projects/active/{id}', ['uses' => 'Admin\ProjectController@active', 'as' => 'projects.active']);
    Route::patch('projects/inactive/{id}', ['uses' => 'Admin\ProjectController@inactive', 'as' => 'projects.inactive']);
    Route::get('projects/job/{id}', ['uses' => 'Admin\ProjectController@update_project_job_detail', 'as' => 'projects.job']);
    Route::post('projects/job/{id}', ['uses' => 'Admin\ProjectController@insert_project_job_data', 'as' => 'projects.insertjobdata']);
    Route::get('projects/salary/{id}', ['uses' => 'Admin\ProjectController@update_project_salary_detail', 'as' => 'projects.salary']);
    Route::post('projects/salary/{id}', ['uses' => 'Admin\ProjectController@update_project_salary_data', 'as' => 'projects.salarydata']);
    Route::get('projects/experience/{id}', ['uses' => 'Admin\ProjectController@update_project_experience_detail', 'as' => 'projects.experience']);
    Route::post('projects/experience/{id}', ['uses' => 'Admin\ProjectController@update_project_experience_data', 'as' => 'projects.experiencedata']);
    Route::get('projects/calls/{id}', ['uses' => 'Admin\ProjectController@unit_calls', 'as' => 'projects.calls']);
    Route::post('projects/calls/{id}', ['uses' => 'Admin\ProjectController@update_unit_calls', 'as' => 'projects.callsdata']);
    Route::get('projects/schedule/{id}', ['uses' => 'Admin\ProjectController@project_schedule', 'as' => 'projects.schedule']);

    Route::get('projects/recce/{id}', ['uses' => 'Admin\ProjectController@recce', 'as' => 'projects.recce']);

    Route::post('projects/schedule/{id}', ['uses' => 'Admin\ProjectController@update_project_schedule', 'as' => 'projects.scheduledata']);
    Route::get('projects/recce/{id}', ['uses' => 'Admin\ProjectController@project_recce', 'as' => 'projects.recce']);
    Route::post('projects/recce/{id}', ['uses' => 'Admin\ProjectController@update_project_recce', 'as' => 'projects.reccedata']);
    Route::get('projects/documents/{id}', ['uses' => 'Admin\ProjectController@project_documents', 'as' => 'projects.documents']);
    Route::post('projects/documents/{id}', ['uses' => 'Admin\ProjectController@update_project_documents', 'as' => 'projects.documentdata']);
    Route::get('projects/cast_call/{id}', ['uses' => 'Admin\ProjectController@project_cast_call', 'as' => 'projects.cast_call']);
    Route::post('projects/cast_call/{id}', ['uses' => 'Admin\ProjectController@update_project_cast_call', 'as' => 'projects.castcalldata']);

    Route::post('projects/cast_call/{id}', ['uses' => 'Admin\ProjectController@update_project_cast_call', 'as' => 'projects.castcalldata']);


    Route::get('user_projects', ['uses' => 'Admin\ProjectController@user_projects', 'as' => 'projects.user_projects']);

    Route::get('create_user_projects', ['uses' => 'Admin\ProjectController@create_user_projects', 'as' => 'projects.create_user_projects']);

    Route::post('store_user_projects', ['uses' => 'Admin\ProjectController@store_user_projects', 'as' => 'projects.store_user_projects']);
    Route::post('update_user_projects/{id}', ['uses' => 'Admin\ProjectController@update_user_projects', 'as' => 'projects.update_user_projects']);

    Route::get('doc_profile/{id}', ['uses' => 'Admin\UsersController@profile', 'as' => 'users.profile']);

    Route::get('edit_user_projects/{id}', ['uses' => 'Admin\ProjectController@edit_user_projects', 'as' => 'projects.edit_user_projects']);
    Route::get('delete_user_projects/{id}', ['uses' => 'Admin\ProjectController@delete_user_projects', 'as' => 'projects.delete_user_projects']);

Route::post('projects/save_day', ['uses' => 'Admin\ProjectController@save_day', 'as' => 'projects.save_day']);

Route::post('projects/get_unit_data', ['uses' => 'Admin\ProjectController@get_unit_data', 'as' => 'projects.get_unit_data']);

Route::post('projects/get_cast_data', ['uses' => 'Admin\ProjectController@get_cast_data', 'as' => 'projects.get_cast_data']);

Route::post('projects/get_schedule_data', ['uses' => 'Admin\ProjectController@get_schedule_data', 'as' => 'projects.get_schedule_data']);

Route::post('projects/get_recce_data', ['uses' => 'Admin\ProjectController@get_recce_data', 'as' => 'projects.get_recce_data']);

Route::get('home/applicants/{id}', ['uses' => 'HomeController@applicants', 'as' => 'home.applicants']);

Route::post('applicants', ['uses' => 'Admin\HomeControoler@Schoolfilter', 'as' => 'index.applicants']);

Route::get('home/admin_token/{token}', ['uses' => 'HomeController@admin_token', 'as' => 'home.admin_token']);


    Route::resource('projects', 'Admin\ProjectController');
    // Project Resrouce Ends Here

    Route::resource('alerts', 'Admin\AlertsController');


});

