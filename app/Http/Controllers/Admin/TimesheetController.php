<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimesheetRequest;
use App\Http\Requests\Admin\UpdateTimesheetRequest;
use App\Helpers\PermissionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Timesheet;
use App\Models\Admin\Job;
use Auth;
use Config;
use App\Models\Admin\UserDevices;
use App\Helpers\PermissionHelper as Per;
use App\Helpers\GeneralHelper;

class TimesheetController extends Controller
{

    /**
     * Display a listing of Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Per::has_permission('timesheet_manage')) {
            return abort(401);
        }

        $logged_in = Auth::user();
        $timesheet_array = ['timesheet', 'notify',  'approved','payroll'];

        if($logged_in->role_id == 2){

            $Timesheets = Timesheet::selectRaw('timesheet.*')->join('job',  'job.id' ,'timesheet.job_id')
                ->where(['job.departments_id'=> $logged_in->dept_id])
                ->whereIn('job.overall_status', $timesheet_array)
                ->get();

//            dd($Timesheets);
        }else{

            $Timesheets = Job::selectRaw('timesheet.*')->join('timesheet', 'timesheet.job_id', 'job.id' )
                ->whereIn('job.overall_status', $timesheet_array)
                ->get();
        }
//        if($logged_in ->role_id == 2){
//            $Timesheets = Timesheet::where('dept_id', $logged_in->dept_id)->OrderBy('created_at','desc')->get();
//        }else{
//            $Timesheets = Timesheet::OrderBy('created_at','desc')->get();
//        }

//        dd($Timesheets);

        return view('admin.timesheet.index', compact('Timesheets','logged_in'));
    }

    /**
     * Show the form for creating new Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Timesheets = Timesheet::OrderBy('created_at','desc')->get();

        return view('admin.timesheet.create', compact('Timesheets'));
    }

    /**
     * Store a newly created Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimesheetRequest $request)
    {
       $data= $request->all();
        $data['created_by']=Auth::user()->id;
        $data['updated_by']=Auth::user()->id;

        Timesheet::create($data);
       
        session()->flash('success', 'Record has been created successfully.');
        return redirect()->route('admin.timesheet.index');
    }


    /**
     * Show the form for editing Setting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Timesheets = Timesheet::findOrFail($id);
        
        return view('admin.timesheet.edit', compact('Timesheets'));
    }

    public function show($id)
    {
        $Timesheets = Timesheet::find($id);
        // dd($Timesheets);
        return view('admin.timesheet.display', compact('Timesheets'));
    }

    /**
     * Update Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateSettingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimesheetRequest $request, $id)
    {
        $Timesheets = Timesheet::findOrFail($id);
            
        $data = $request->all();

        $data['updated_at'] = Auth::user()->id;

        $Timesheets->update($data);
        session()->flash('success', 'Record has been updated successfully.');

        return redirect()->route('admin.timesheet.index');
    }


    /**
     * Remove Setting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Timesheets = Timesheet::findOrFail($id);
        //        $employee_exp = employee_experience::findOrFail($id);
        
                $Timesheets->delete();

        return redirect()->route('admin.timesheet.index');
    }

    public function change_status($job_id,$status)
    {
//        $tim = Timesheet::findOrFail($time_id);
//        $tim->update(['status' => $status]);
//        session()->flash('success', 'Record has been updated successfully.');
//        return redirect()->route('admin.timesheet.index');

        // in case ( hired, reject(to hod), notify, approved, sent to payroll by manager generate email,

//        dd($job_id,$status);

        $job = Job::findOrFail($job_id);
        $user_id = Timesheet::where('job_id', $job_id)->pluck('users_id')->first();


        $tokens = UserDevices::where('user_id', $user_id)->pluck('device_token');

        $job->update(['overall_status' => $status]);
        $completed_array = ['timesheet', 'notify',  'approved'];
        $message = '';
        if($status == 'approved'){
            $message = 'APPROVED';
        }
        if($status == 'payroll'){
            $message = 'sent to payroll';
        }

        if(count($tokens) > 0 && $message != ''){

            $title = 'Congratulation !';
            $body = 'Your timesheet for '. strtoupper($job->title) .' for the date '. date('d/m/Y', strtotime($job->date)).' has been '.$message;

            $data = array(
                'page'=>'timesheet',
                'job_id' => $job->id,
                'status' => $status
            );

            GeneralHelper::sendGCM($tokens, $title,  $body, $data);
        }

        session()->flash('success', 'Status Changed successfully.');
        if(in_array($status,$completed_array)){
            return redirect()->route('admin.timesheet.index');
        }

        return redirect()->route('admin.timesheet.index');

    }

}
