<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobRequest;
use App\Http\Requests\Admin\UpdateJobRequest;

use App\Models\Admin\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\RolePermission;
use App\Helpers\PermissionHelper as Per;
use App\Models\Admin\Departments;
use App\Models\Admin\Hospital;
use App\Models\Admin\Jobdetail;
use App\Models\Admin\Job;
use App\User;
use Auth;
use Config;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Per::has_permission('job_manage')) {
            return abort(401);
        }


        $logged_in = Auth::user();
        // get draft or posted jobs only
        $Hospital = Hospital::all()->pluck('name','id');
        $Hospital->prepend('Select Hospital','');

        $Departments = Departments::all()->pluck('name','id');
        $Departments->prepend('Select Department','');

        $normal_array = ['draft', 'publish', 'reject'];
        $status_array = [
            'draft'     =>'Draft', 
            'publish'   =>'Publish',
            'reject'   =>'Rejected',
        ];

        if($logged_in->role_id == 2){
            $Jobs = Job::where(['departments_id'=> $logged_in->dept_id])->whereIn('overall_status',$normal_array)->OrderBy('created_at','desc')->get();
        }else{
            $Jobs = Job::whereIn('overall_status',$normal_array)->OrderBy('created_at','desc')->get();
        }
//        dd($Jobs);
        $filter_date = '';
        $filter_status = '';
        return view('admin.job.index', compact('Jobs','logged_in','Hospital','Departments','status_array','filter_date','filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Per::has_permission('job_create')) {
            return abort(401);
        }
        $logged_in = Auth::user();

        $grades = Grade::pluck('name', 'id');
        $grades->prepend('Select a grade','');

        $curr_Date = Date('Y-m-d');
        $job_date = date('d/m/Y', strtotime($curr_Date. ' + 1 days'));
        // only hod can create jobs
        if($logged_in->role_id == 2){

        }

        return view('admin.job.create', compact('grades','job_date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $logged_in = Auth::user();
        $data['users_id'] = $logged_in->id;
        $data['hospital_id'] = $logged_in->hospital_id;
        $data['departments_id'] = $logged_in->dept_id;
        $data['created_by'] = $logged_in->id;
        $data['updated_by'] = $logged_in->id;
        $var = $data['date'];
        $date = str_replace('/', '-', $var);
        $formated_date = date('Y-m-d', strtotime($date));
        $data['date'] = $formated_date;

        $job = Job::create($data);

        $unit_lineitems=array();
        $line_items_array_start = $data['line_items']['grade_id'];

        foreach ($line_items_array_start as $key => $val) {
            if($key != '######'){

                $temp_data = array(
                    'job_id' => $job->id,
                    'grade_id' => $data['line_items']['grade_id'][$key],
                    'rate' => $data['line_items']['rate'][$key],
                    'time_from' => $data['line_items']['time_from'][$key],
                    'time_to' => $data['line_items']['time_to'][$key],
//                    'vacancies' => $data['line_items']['vacancies'][$key],

                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                );

                array_push($unit_lineitems, $temp_data);
            }

        }

        Jobdetail::insert($unit_lineitems);

        session()->flash('success', 'Record has been created successfully.');
        return redirect()->route('admin.job.index');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Job = Job::findOrFail($id);
        if($Job->status > 1){

            session()->flash('error', 'You cannot edit a published job');
            return redirect()->route('admin.job.index');
        }

        $logged_in = Auth::user();

        $Jobdetail = Jobdetail::where('job_id', $id)->get();

        $grades = Grade::pluck('name', 'id');
        $grades->prepend('Select a grade','');
//        dd($logged_in);
        // only hod can create/edit jobs
        if($logged_in->role_id == 2){

        }
        $job_date = $Job->date;
        return view('admin.job.edit', compact('Job','Jobdetail','users','grades','job_date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $job = Job::findOrFail($id);
        if($job->status > 1){
            dd('Cannot edit');
        }

        $data = $request->all();

        $logged_in = Auth::user();

        $data['updated_by'] = $logged_in->id;

        $job->update($data);

//        Jobdetail::where('job_id', $id)->delete();
        $unit_lineitems=array();
        $line_items_array_start = $data['line_items']['grade_id'];

        foreach ($line_items_array_start as $key => $val) {

            if(isset($data['line_items']['db_id'][$key])){
                $temp_data = array(
                    'job_id' => $job->id,
                    'grade_id' => $data['line_items']['grade_id'][$key],
                    'rate' => $data['line_items']['rate'][$key],
                    'time_from' => $data['line_items']['time_from'][$key],
                    'time_to' => $data['line_items']['time_to'][$key],

                    'updated_by' => $logged_in->id,
                    'updated_at' => \Carbon\Carbon::now()
                );

                Jobdetail::where('id', $data['line_items']['db_id'][$key])->update($temp_data);

            } else{
                $temp_data = array(
                    'job_id' => $job->id,
                    'grade_id' => $data['line_items']['grade_id'][$key],
                    'rate' => $data['line_items']['rate'][$key],
                    'time_from' => $data['line_items']['time_from'][$key],
                    'time_to' => $data['line_items']['time_to'][$key],

                    'created_by' => $logged_in->id,
                    'updated_by' => $logged_in->id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                );

                array_push($unit_lineitems, $temp_data);
            }

        }

        if( count($unit_lineitems) > 0 ){
            Jobdetail::insert($unit_lineitems);
        }

        session()->flash('success', 'Record has been updated successfully.');
        return redirect()->route('admin.job.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //

    }

    public function change_status($job_id,$status)
    {
        //
        // dd($status);
        $job = Job::findOrFail($job_id);

        $job->update(['status' => $status]);
        session()->flash('success', 'Record has been updated successfully.');
        return redirect()->route('admin.job.index');

    }
    public function save_status($job_id)
    {
        //
        // dd($status);
        $job = Job::findOrFail($job_id);
        $save['save_status'] = 1;
        $job->update($save);
       
        session()->flash('success', 'Shift has been saved in saved shifts successfully.');
        return redirect()->route('admin.job.index');

    }

    public function job_status($job_id,$status)
    {
        //
        // dd($status);
        // in case ( hired, reject(to hod), notify, approved, sent to payroll by manager generate email,
        $job = Job::findOrFail($job_id);

        $job->update(['overall_status' => $status]);
        $completed_array = ['timesheet', 'notify',  'approved'];
        session()->flash('success', 'Record has been updated successfully.');
        if(in_array($status,$completed_array)){
            return redirect()->route('admin.job.completed');
        }

        return redirect()->route('admin.job.index');

    }

    public function get_job_grades($id)
    {
        $job_detail = Jobdetail::where(['job_id' => $id])->with('grade_name')->get();

        $response_array = array();

        foreach ($job_detail as $key => $value){
            $temp_array = array(
                'grade'=> $value->grade_name->name,
                'rate'=> $value->rate,
                'from'=> date('g:i a', strtotime($value->time_to)),
                'to'=> date('g:i a', strtotime($value->time_from))
            );
            array_push($response_array, $temp_array);
        }
        return response()->json($response_array);


    }

    public function repost($id)
    {

        $Job = Job::findOrFail($id);

        $logged_in = Auth::user();

        $Jobdetail = Jobdetail::where('job_id', $id)->get();

        $curr_Date = Date('Y-m-d');

        $job_date = date('d/m/Y', strtotime($curr_Date. ' + 1 days'));
        $grades = Grade::pluck('name', 'id');
        $grades->prepend('Select a grade','');

        // only hod can create/edit jobs
        if($logged_in->role_id == 2){

        }

        return view('admin.job.repost', compact('Job','Jobdetail','grades','job_date'));


    }


    public function archived()
    {
        if (! Per::has_permission('job_manage')) {
            return abort(401);
        }
        $logged_in = Auth::user();
        // get draft or posted jobs only

//        $archive_array = ['close', 'expire',  'payroll']
        $archive_array = ['close', 'expire'];
        if($logged_in->role_id == 2){
            $Jobs = Job::where(['departments_id'=> $logged_in->dept_id])->whereIn('overall_status',$archive_array)->orderby('created_at')->get();
        }else{
            $Jobs = Job::whereIn('overall_status',$archive_array)->orderby('created_at')->get();
        }

        return view('admin.job.archived', compact('Jobs','logged_in'));
    }


    public function completed()
    {
        if (! Per::has_permission('job_manage')) {
            return abort(401);
        }
        $logged_in = Auth::user();
        // get draft or posted jobs only
        //
//        $completed_array = ['timesheet', 'notify',  'approved','payroll'];
        $completed_array = ['payment'];


        if($logged_in->role_id == 2){
            $Jobs =  Job::selectRaw('job.*, applications.job_detail_id detail_id, grades.name grade_name, 
            job_details.rate rate , job_details.time_from grade_time_from, job_details.time_to grade_time_to, applications.user_id as doctor_id, users.name as doctor_name')
            ->join('applications', 'applications.job_id', '=', 'job.id')
            ->join('job_details', 'applications.job_detail_id', '=', 'job_details.id')
            ->join('users', 'applications.user_id', '=', 'users.id')
            ->join('grades', 'job_details.grade_id', '=', 'grades.id')
            ->where(['departments_id' => $logged_in->dept_id])
            ->where('applications.status', 2)
            ->where('job.overall_status', $completed_array)
            ->get();
        }else{
            $Jobs = Job::whereIn('overall_status',$completed_array)->orderby('created_at')->get();
        }

        
        return view('admin.job.completed', compact('Jobs','logged_in'));
    }

    public function Schoolfilter(Request $request){
        $data = $request->all();

//        dd($data);

        $logged_in = Auth::user();
        // get draft or posted jobs only
        $Hospital = Hospital::all()->pluck('name','id');
        $Hospital->prepend('Select Hospital','');

        $Departments = Departments::all()->pluck('name','id');
        $Departments->prepend('Select Department','');
        $normal_array = ['draft', 'publish', 'reject'];
        $status_array = [
            'draft'     =>'Draft',
            'publish'   =>'Publish',
            'reject'   =>'Reject',
        ];


        $where = array();
        if(isset($data['hospital_id'])){
            $where['hospital_id'] = $data['hospital_id'];

        }
        if(isset($data['dept_id'])){
            $where['departments_id'] = $data['dept_id'];
        } 
      
        $adminwhere = array();
        $formated_date='';
        $filter_date = '';
        $filter_status = '';
        if(isset($data['date'])){
            $filter_date = $data['date'];
            $date = str_replace('/', '-', $data['date']);
            $formated_date = date('Y-m-d', strtotime($date));
            $where['date'] = $formated_date;

        }
        if(isset($data['status'])){
            $filter_status = $data['status'];
            $where['overall_status'] = $data['status'];
        }

        if($logged_in->role_id == 2){
            //$Jobs = Job::whereDate('created_at',$data['date'])->OrWhere('overall_status', $data['status'])->OrderBy('created_at','desc')->get();
            if(isset($data['status'])){
                $Jobs = Job::where($where)->OrderBy('created_at','desc')->get();
            }else{
                $Jobs = Job::where($where)->whereIn('overall_status',$normal_array )->OrderBy('created_at','desc')->get();
            }
        }else{
            if(isset($data['status'])){
                $Jobs = Job::where($where)->OrderBy('created_at','desc')->get();
            }else{
                $Jobs = Job::where($where)->whereIn('overall_status',$normal_array )->OrderBy('created_at','desc')->get();
            }
        }

        return view('admin.job.index', compact('Jobs','logged_in','Hospital','Departments','status_array','filter_date','filter_status'));
    }

    public function save_jobs()
    {
        if (! Per::has_permission('job_manage')) {
            return abort(401);
        }


        $logged_in = Auth::user();
        // get draft or posted jobs only
        $Hospital = Hospital::all()->pluck('name','id');
        $Hospital->prepend('Select Hospital','');

        $Departments = Departments::all()->pluck('name','id');
        $Departments->prepend('Select Department','');

        $normal_array = ['draft', 'publish', 'reject'];
        $status_array = [
            'draft'     =>'Draft', 
            'publish'   =>'Publish',
            'reject'   =>'Rejected',
        ];

        if($logged_in->role_id == 2){
            $Jobs = Job::where(['departments_id'=> $logged_in->dept_id])->where('save_status',1)->OrderBy('created_at','desc')->get();
        }else{
            $Jobs = Job::where('save_status',1)->OrderBy('created_at','desc')->get();
        }
        $filter_date = '';
        $filter_status = '';
        return view('admin.job.savejobs', compact('Jobs','logged_in','Hospital','Departments','status_array','filter_date','filter_status'));
    }


    public function hired_jobs()
    {
        if (! Per::has_permission('job_manage')) {
            return abort(401);
        }
        $logged_in = Auth::user();
        // get draft or posted jobs only
        //

        if($logged_in->role_id == 2){

            $Jobs =  Job::selectRaw('job.*, applications.job_detail_id detail_id, grades.name grade_name, 
            job_details.rate rate , job_details.time_from grade_time_from, job_details.time_to grade_time_to, applications.user_id as doctor_id, users.name as doctor_name')
            ->join('applications', 'applications.job_id', '=', 'job.id')
            ->join('job_details', 'applications.job_detail_id', '=', 'job_details.id')
            ->join('users', 'applications.user_id', '=', 'users.id')
            ->join('grades', 'job_details.grade_id', '=', 'grades.id')
            ->where(['departments_id' => $logged_in->dept_id])
            ->where('applications.status', 2)
            ->where('job.overall_status','hire')
            ->get();


//            $Jobs = Job::where(['departments_id'=> $logged_in->dept_id])->where('overall_status','hire')->orderby('created_at')->get();
        }else{
            $Jobs = Job::where('overall_status','hire')->orderby('created_at')->get();
        }

        return view('admin.job.hired', compact('Jobs','logged_in'));
    }

    public function timeSheet()
    {
        if (! Per::has_permission('job_manage')) {
            return abort(401);
        }
        $logged_in = Auth::user();
        // get draft or posted jobs only
        //
        $completed_array = ['timesheet', 'notify',  'approved','payroll'];
//        $completed_array = ['payment'];


        if($logged_in->role_id == 2){
            $Jobs = Job::where(['departments_id'=> $logged_in->dept_id])->whereIn('overall_status',$completed_array)->orderby('created_at')->get();
        }else{
            $Jobs = Job::whereIn('overall_status',$completed_array)->orderby('created_at')->get();
        }

        return view('admin.job.completed', compact('Jobs','logged_in'));
    }

}
