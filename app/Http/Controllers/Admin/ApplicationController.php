<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreApplicationRequest;
use App\Http\Requests\Admin\UpdateApplicationRequest;
use App\Helpers\PermissionHelper as Per;
use App\Helpers\GeneralHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Application;
use App\Models\Admin\Job;
use App\Models\Admin\UserDevices;

use Auth;
use Config;

class ApplicationController extends Controller
{

    /**
     * Display a listing of Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Per::has_permission('application_manage')) {
            return abort(401);
        }
        $logged_in = Auth::user();

        $curr_Date = Date('Y-m-d');
        if($logged_in->role_id == 2){
            $Applications = Application::where('dept_id', $logged_in->dept_id)->OrderBy('created_at','desc')->get();
            
        }else{
            $Jobs_application =  Job::selectRaw('job.title,job.time_to,job.time_from, job.date job_date,num_of_grades, COUNT(applications.id) apps')
                ->leftJoin('applications', 'applications.job_id', '=', 'job.id')

                ->where(['departments_id' => $logged_in->dept_id])
                ->whereDate('date', '>', $curr_Date)
                ->where('overall_status','publish')
                ->groupBy('job_id','title','date','time_from','time_to','num_of_grades')
                ->get();

//            $Applications = Application::OrderBy('created_at','desc')->get();
        }


//dd($Jobs_application);

//        return view('admin.application.index', compact('Applications','logged_in'));
        return view('admin.application.published', compact('Jobs_application','logged_in'));
    }

    /**
     * Show the form for creating new Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Applications = Application::OrderBy('created_at','desc')->get();

        return view('admin.application.create', compact('Applications'));
    }

    /**
     * Store a newly created Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplicationRequest $request)
    {
       $data= $request->all();
        $data['created_by']=Auth::user()->id;
        $data['updated_by']=Auth::user()->id;
        $data['created_at'] = \Carbon\Carbon::now();
        $data['updated_at'] = \Carbon\Carbon::now();
        Application::create($data);

        session()->flash('success', 'Record has been created successfully.');
        return redirect()->route('admin.application.index');
    }


    /**
     * Show the form for editing Setting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Applications = Application::findOrFail($id);

        return view('admin.application.edit', compact('Applications'));
    }

    /**
     * Update Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateSettingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicationRequest $request, $id)
    {
        $Applications = Application::findOrFail($id);

        $data = $request->all();

        $data['updated_at'] = Auth::user()->id;

        $Applications->update($data);
        session()->flash('success', 'Record has been updated successfully.');

        return redirect()->route('admin.application.index');
    }


    /**
     * Remove Setting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Applications = Application::findOrFail($id);
        //        $employee_exp = employee_experience::findOrFail($id);

                $Applications->delete();

        return redirect()->route('admin.application.index');
    }

    public function change_status($app_id,$status)
    {
        $app = Application::findOrFail($app_id);

        // if status is 2 mean hire send push notifications

        // Mark job as hired and

        Job::where('id', $app->job_id)->update([ 'hire_status' => '2' ,'overall_status' => 'hire']);
        $app->update(['status' => $status]);
        $tokens = UserDevices::where('user_id', $app->user_id)->pluck('device_token');

        if(count($tokens) > 0){
            $title = 'Congratulation !';
            $body = 'You have been hired for '. strtoupper($app->job_name->title) .' for the date '.  $job_date = date('d/m/Y', strtotime($app->job_name->date));
            $data = array(
                'page'=>'hire', 'job_id' => $app->job_name->id
            );
            GeneralHelper::sendGCM($tokens, $title,  $body, $data);
        }

        session()->flash('success', 'Record has been updated successfully.');
        return redirect()->route('admin.application.index');

    }
    public function cancelled()
    {
        if (! Per::has_permission('application_manage')) {
            return abort(401);
        }

        $logged_in = Auth::user();
        if($logged_in->role_id == 2){
            $Applications = Application::where('dept_id', $logged_in->dept_id)->where('status',0)->OrderBy('created_at','desc')->get();

        }else{
            $Applications = Application::OrderBy('created_at','desc')->get();
        }


//dd($Applications);

        return view('admin.job.cancelled', compact('Applications','logged_in'));
    }

}
