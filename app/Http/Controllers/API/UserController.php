<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Experience;
use App\Models\Admin\Job;
use App\Models\Admin\Application;
use App\Models\Admin\Jobdetail;

use App\Models\Admin\Timesheet;

use App\User;
use App\Models\Admin\Hospital;
use App\Models\Admin\Departments;
use App\Models\Admin\Grade;
use App\Models\Admin\Prefs;
use App\Models\Admin\UserDevices;

use Auth;
use App\Helpers\GeneralHelper;
use Config;
use DB;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
//    public function login()
//    {
//        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
//            $user = Auth::user();
//            $success['token'] =  $user->createToken('MyApp')->accessToken;
//            $success['user'] =  $user;
//            return response()->json(['success' => $success], $this->successStatus);
//        }
//        else{
//            return response()->json(['error'=>'Unauthorised'], 401);
//        }
//    }


    public function login(Request $request)
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->accessToken;
            $user->token = $token;
            if(  isset($request->device_token) )  {
                UserDevices::create(['user_id' => $user->id , 'device_token' => $request->device_token]);
            }

            $user->image_path = $user->image ?  url('/public/uploads/doctors/'. $user->image) : null;
            $user->id_image = $user->id_image ?  url('/public/uploads/doctors/'. $user->id_image) : null;
            $user->doc_hosp_name = $user->hosp_name->name;
            $user->doc_dept_name = $user->dep_name->name;
            //$success['user'] =  $user;
            return response()->json(['user' => $user], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }



    public function logout(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'device_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $UserDevices = UserDevices::where('device_token', $request->device_token)->delete();
        return response()->json(['success' => 'User logged out successfully'], $this->successStatus);
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }


//		return response()->json($input);
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function registerUser(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'first_name' => 'required',
            'sur_name' => 'required',
            'gmc' => 'required',
            'doc_hospital' => 'required',
            'doc_dept' => 'required',
//            'hospital_user_id' => 'required',

            'mobile' => 'required',
            // 'image' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();

        $bas64 = $request->image;

        $id_image = $request->id_image;


        $file_name = 'image_' . time() . '.png'; //generating unique file name;

        if ($bas64 != "") { // storing image in storage/app/public Folder

            file_put_contents('public/uploads/doctors/'.$file_name, base64_decode($bas64));
            $input['image'] = $file_name;
        }

        if ($id_image != "") { // storing image in storage/app/public Folder
            $id_name = 'id_' . time() . '.png'; //
            file_put_contents('public/uploads/doctors/'.$id_name, base64_decode($id_image));
            $input['id_image'] = $id_name;
        }


        $input['password'] = bcrypt($input['password']);
//        dd($input);
        $input['role_id'] = 3;
        $user = User::create($input);
        if(  isset($request->device_token) )  {
            UserDevices::create(['user_id' => $user->id , 'device_token' => $request->device_token]);
        }

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $user->doc_hosp_name = $user->hosp_name->name;
        $user->doc_dept_name = $user->dep_name->name;
        $user->image_path =  url('/public/uploads/doctors/'. $user->image);
        $user->id_image =  url('/public/uploads/doctors/'. $user->id_image);

        $success['user'] =  $user;

        return response()->json(['success'=>$success], $this->successStatus);

    }

    public function storeExperience(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'hospital_id' => 'required',
            'dept_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'job_title' => 'required',
            'id_card' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['doctor_id'] = Auth::user()->id;
        $experience = Experience::create($input);
        $experience = Experience::where('doctor_id', Auth::user()->id )->get();
        return response()->json(['success' => $experience], $this->successStatus);
    }

    public function updateProfile(Request $request, $id)
    {
        //    dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user = User::findOrFail($id);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $update_profile = $user->update($input);
        $update_profile->doc_hosp_name = $user->hosp_name->name;
        $update_profile->doc_dept_name = $user->dep_name->name;
        $success['data'] =  $update_profile;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function jobDetail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'job_id' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $jobs = Job::where('id', $request->job_id)->first();
        $job_detail = Jobdetail::where('job_id', $request->job_id)->get();
//        $appllied = Application::where(['job_id' => $request->job_id, 'user_id' => Auth::user()->id])->whereIn('status' , [1,2] )->get();
        $appllied = Application::where(['job_id' => $request->job_id, 'user_id' => Auth::user()->id , 'status' => 1])->first();
        $job_array = array();
        foreach ($job_detail as $key => $value){
            $temp_array['id'] = $value->id;
            $temp_array['job_id'] = $value->job_id;
            $temp_array['grade_id'] = $value->grade_id;
            $temp_array['time_to'] = date('H:i', strtotime($value->time_to));
            $temp_array['time_from'] = date('H:i', strtotime($value->time_from));
//            date('H:i', strtotime($value->time_to));
//            $temp_array['time_from'] = $value->time_from;

            $temp_array['grade_name'] = $value->grade_name->name;
            $temp_array['rate'] = $value->rate;
            $temp_array['is_appllied'] = isset($appllied) && $appllied->job_detail_id == $value->id ? 1 : 0;
            array_push($job_array, $temp_array);
        }

        $job_info['hospital_name'] = $jobs->hosp_name->name;
        $job_info['department_name'] = $jobs->dep_name->name;
        $job_info['admin_email'] = $jobs->user_name->email;
        $job_info['admin_phone'] = $jobs->user_name->mobile;

        $job_info['id'] = $jobs->id;
        $job_info['hospital_id'] = $jobs->hospital_id;
        $job_info['departments_id'] = $jobs->departments_id;
        $job_info['hire_status'] = $jobs->hire_status;
        $job_info['overall_status'] = $jobs->overall_status;
        $job_info['time_from'] = date('H:i', strtotime($jobs->time_from));
        $job_info['time_to'] = date('H:i', strtotime($jobs->time_to));

        $job_info['description'] = $jobs->description;
        $job_info['title'] = $jobs->title;
        $job_info['date'] = date("d/m/Y", strtotime($jobs->date)) ;
        $job_info['num_of_grades'] = $jobs->num_of_grades;
        $job_info['applied_status'] = count((array)$appllied) > 0 ? 1 : 0;
        $job_info['job_detail_id'] = isset($appllied) ? $appllied->job_detail_id  : '';

        $success['applied_status'] = count((array)$appllied) > 0 ? 1 : 0;
        $success['data'] =  $job_info;
        $success['data_detail'] =  $job_array;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function jobApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'job_id' => 'required',
            'job_detail_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if(Auth::user()->approved == 0){
            return response()->json(['error' => 'Please wait for the approval from locumset' ], 401);
        }

        $job = Job::where(['id'=> $request->job_id, 'overall_status' => 'publish'])->first();
        if($job){
            $admin_token = User::where('id', $job->users_id)->first();
            $token = 'fn1hoiE86tv166W4NeyrUd:APA91bEyhYMKNGB--k4LRzMJ4IwmrQv8ZUov2rXSMzHbWho_Xmm1hBySZbQsnr-DW03Lw3GPUHiQ_FIXOOmOfq1en7Yuqyo4z25TBNUYiYJKSZSEugzxczuYDRj73smD94JY31zfd6zh';
//            GeneralHelper::sendWeb( $token ,'New Job Application', ' applied for the shift ','http://rms.socialtypingtest.com/admin/application');
//            dd($admin_token->device_token);
        // check for already applied on same date and time
//        $same_date_jobs = Job::where(['date'=> $job->date, 'overall_status' => 'publish'])->get();
        $user_id = Auth::user()->id;
        $same_date_jobs =  Job::selectRaw('job.id, applications.job_detail_id detail_id')
            ->join('applications', 'applications.job_id', '=', 'job.id')
            ->where('applications.user_id', $user_id)
            ->where('applications.status', 1)
            ->where('job.overall_status','publish')
            ->where('job.date', $job->date)
            ->get();

        $job_detail_info = Jobdetail::where('id',$request->job_detail_id )->first();

        foreach ($same_date_jobs as $key => $value){

            $applied_detail = Jobdetail::where('id',$value->detail_id )->first();
            if($applied_detail){
                if( GeneralHelper::isBetween($applied_detail->time_from, $applied_detail->time_to, $job_detail_info->time_from) ||
                    GeneralHelper::isBetween($applied_detail->time_from, $applied_detail->time_to, $job_detail_info->time_to)
                ){
                    return response()->json(['error' => 'Already applied for this job' ], 401);
                }
            }

//            GeneralHelper::isBetween($from, $till, $inputTime);
        }
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['hospital_id'] = $job->hospital_id;
        $input['dept_id'] = $job->departments_id;
        $input['created_by'] = Auth::user()->id;
        $input['applied_date'] = date('Y-m-d');

        $jobApply = Application::create($input);

        $token = 'fn1hoiE86tv166W4NeyrUd:APA91bEyhYMKNGB--k4LRzMJ4IwmrQv8ZUov2rXSMzHbWho_Xmm1hBySZbQsnr-DW03Lw3GPUHiQ_FIXOOmOfq1en7Yuqyo4z25TBNUYiYJKSZSEugzxczuYDRj73smD94JY31zfd6zh';
        if(isset($admin_token->device_token)){
            GeneralHelper::sendWeb( $admin_token->device_token ,'New Job Application', Auth::user()->name.' applied for the shift '. $job->title,'http://rms.socialtypingtest.com/admin/application');
        }

        if(isset($admin_token->email)){

            $mailData['token'] = 'Application';
            $mailData['doctor'] = Auth::user()->name;
            $mailData['shift'] = $job->title;
            $mailData['shift_date'] = date('d/m/Y', strtotime($job->date));
            $data['email'] = 'ehsan950@hotmail.com';

//            $data['email'] = $admin_token->email;

            GeneralHelper::sendMail('locumset@gmail.com', $data['email'], 'mail.application', $mailData , 'New Shift Application for '. $job->title);

        }

        $success['job_application'] =  $jobApply;
        $success['same_date_jobs'] =  $same_date_jobs;
        $success['status'] =  $jobApply ? true : false;
        $success['status'] =  $jobApply ? true : false;

        return response()->json(['success'=>$success], $this->successStatus);

        }else{
            return response()->json(['error'=>'Job is not published anymore'], $this->successStatus);
        }
    }

    public function jobListing(Request $request)
    {
        $data = $request->all();
        $where = array();
        if(isset($data['hospital_id'])){
            $where['hospital_id'] = $data['hospital_id'];

        }
        if(isset($data['departments_id'])){
            $where['departments_id'] = $data['departments_id'];
        }
        $grade=0;
        if(isset($data['grade_id'])){
            $grade = $data['grade_id'];
        }

        $user_id = Auth::user()->id;
        $prefs_status =  false;
        if(isset( $data['pref'] ) ){


            $prefs = Prefs::where('doctor_id', $user_id)->first();

            if(isset($prefs->hospital_id)){
                $prefs_status =  true;
                $where['hospital_id'] = $prefs->hospital_id;
            }
            if(isset($prefs->department_id)){
                $prefs_status =  true;
                $where['departments_id'] = $prefs->department_id;
            }
            if(isset($prefs->grade_id)){
                $prefs_status =  true;
                $grade = $prefs->grade_id;
            }


        }

        if(isset($data['urgent'])){
            $curr_date =  date('Y-m-d');
            $next_date = date('Y-m-d', strtotime($curr_date . ' +1 day'));
            $Jobs = Job::where(['overall_status' => 'publish', 'date' => $next_date])->where($where)->OrderBy('date','asc')->get();


        }else{
            //$Jobs = Job::where('overall_status', 'publish')->where($where)->get();
            $where['overall_status'] = 'publish';
            $Jobs = Job::selectRaw('job.*')
                ->where($where)
                ->OrderBy('date','asc')
                ->get();
        }
        if($grade !=0 ){
            $Jobs = Job::selectRaw('job.*')->join('job_details', 'job_id', 'job.id')
                ->where($where)
                ->where('grade_id', $grade )
                ->OrderBy('date','asc')
                ->get();
        }

        $job_ids =  $Jobs->pluck('id');

        $applications = Application::whereIn('job_id',$job_ids)->where(['user_id'=> $user_id, 'status'=>1])->pluck('job_id')->toArray();

        $jobs_listings = array();
        $curr_Date = Date('Y-m-d');
//        dd($Jobs);
        foreach ( $Jobs as $key => $value ){

            if( $value->date > $curr_Date ){

                $temp_job['id'] = $value->id;
                $temp_job['hospital_id'] = $value->hospital_id;
                $temp_job['departments_id'] = $value->departments_id;

                $temp_job['hospital_name'] = $value->hosp_name->name;
                $temp_job['department_name'] = $value->dep_name->name;

                $temp_job['users_id'] = $value->users_id;
                $temp_job['time_from'] = date('H:i', strtotime($value->time_from));
                $temp_job['time_to'] = date('H:i', strtotime($value->time_to));
                $temp_job['description'] = $value->description;
                $temp_job['title'] = $value->title;
                $temp_job['date'] = date("d/m/Y", strtotime($value->date)) ;// mark as urgent based on post date
                $temp_job['num_of_grades'] = $value->num_of_grades;

                $temp_job['status'] = $value->status;
                $temp_job['applied_status'] = in_array($value->id, $applications) ? 1 : 0;
                $temp_job['rate'] = Jobdetail::where('job_id', $value->id)->max('rate');
                $temp_job['is_urgent'] = 0; // mark as urgent based on post date
                array_push($jobs_listings,$temp_job);
            }
        }

        if(isset( $data['pref'] ) ){
            if(! $prefs_status){
                $jobs_listings = array ();
            }
        }

        return response()->json(['success' => $jobs_listings], $this->successStatus);
    }


    public function get_all_hospitals()
    {
        $Hospital = Hospital::get(['name as label', 'id as value']);
        $Departments = Departments::get(['name as label', 'id as value']);
        $Grade = Grade::get(['name as label', 'id as value']);

        $new_Hospital = Hospital::get(['id', 'name']);
        $new_Departments = Departments::get(['id', 'name']);
        $new_Grade = Grade::get(['id', 'name']);

        return response()->json(['hospitals' => $Hospital, 'departments' => $Departments, 'grades' => $Grade, 'new_hospitals' => $new_Hospital, 'new_departments' => $new_Departments, 'new_grades' => $new_Grade], $this->successStatus);
    }

    public function get_all_dept()
    {
        $Departments = Departments::pluck('name', 'id');
        return response()->json(['success' => $Departments], $this->successStatus);
    }
    public function get_all_grades()
    {
        $Grade = Grade::pluck('name', 'id');
        return response()->json(['success' => $Grade], $this->successStatus);
    }

    public function get_doc_experience(Request $request)
    {
        $experience = Experience::where('doctor_id',Auth::user()->id )->get();
        $experience_array = array();
        foreach ($experience as $key => $value){
//            $temp_array['hosp_name'] = $value->hosp_name->name;
//            $temp_array['dept'] = $value->dep_name->name;

            $temp_array['hosp_name'] = $value->hospital_id;
            $temp_array['dept'] = $value->dept_id;

            $temp_array['from_date'] = date("F", strtotime($value->from_date)).' - '.date("Y", strtotime($value->from_date));

            $temp_array['from_month'] = date("F", strtotime($value->from_date) );
            $temp_array['from_year'] = date("Y", strtotime($value->from_date));

            $temp_array['to_month'] = date("F", strtotime($value->to_date) );
            $temp_array['to_year'] = date("Y", strtotime($value->to_date));

            $temp_array['to_date'] = date("F", strtotime($value->to_date)).' - '.date("Y", strtotime($value->to_date));
            $temp_array['job_title'] = $value->job_title;
            $temp_array['id_card'] = $value->id_card;
            array_push($experience_array,$temp_array);
        }
        return response()->json(['success' => $experience_array], $this->successStatus);
    }

    public function submit_time_sheet (Request $request){
        $validator = Validator::make($request->all(), [

            'job_id' => 'required',
            'grade_id' => 'required',
            'detail_id' => 'required',
            'time_to' => 'required',
            'time_from' => 'required',
            'rate' => 'required',
            'job_amount' => 'required',
            'job_hours' => 'required',



        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $data = $request->all();

        $job = Job::where('id', $request->job_id)->first();

        if( $job->overall_status != 'hire' ){
            return response()->json(['error'=> 'Cannot Submit timesheet to this job'], 401);
        }

        $file_name = null;
        $signature = $request->signature;
        if($signature !=""){
            $signature_string = explode( ',', $signature );
            $file_name = 'sig_' . time() . '.png'; //generating unique file name;
            file_put_contents('public/uploads/sig/'.$file_name, base64_decode($signature_string[1]));
            $data['signature'] = $file_name;
        }

        $data['doctor_id'] = Auth::user()->id;


        $data['date'] = date('Y-m-d');
        $data['users_id'] = $data['doctor_id'];

        $data['hospital_id'] = $job->hospital_id;
        $data['dept_id'] = $job->departments_id;
        $input_fromdate = str_replace('/', '-', $data['date_from']);
        $input_todate = str_replace('/', '-', $data['date_from']);
        $data['date_from'] = date("Y-m-d", strtotime($input_fromdate) );
        $data['date_to'] = date("Y-m-d", strtotime($input_todate) );
        // begin transaction
        Timesheet::create($data);

//        hospital_id , departments_id
        $job->update(['overall_status' => 'timesheet']);
        // end transaction
        return response()->json(['success' => $data], $this->successStatus);

    }

    public function save_prefs (Request $request){

        $data = $request->all();

        $prefs = Prefs::where('doctor_id', Auth::user()->id)->first();
        if(count((array)$prefs) > 0){
            $prefs->update($data);
            //update existing prefs
        }else{
            //insert new prefs
            $data['doctor_id'] = Auth::user()->id;
            $prefs = Prefs::create($data);
        }

        return response()->json(['success' => $prefs, 'message' => 'Prefrences Saved Succefully'], $this->successStatus);
    }


    public function get_doc_prefs (Request $request){

        $prefs = Prefs::where('doctor_id', Auth::user()->id)->first();

        return response()->json(['success' => $prefs], $this->successStatus);
    }

    public function reset_pass (Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'current_password' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }


        $data = $request->all();
        $data['doctor_id'] = Auth::user()->id;
        $user = User::findOrFail($data['doctor_id']);
        $result = password_verify($data['old_password'] , $user->password);
        if($result){
            $user->update(['password' => bcrypt ($data['current_password']) ]);
        }else{
            return response()->json(['error' => 'Old password did not match'], 401);
        }
        $success['data'] =  $user;
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function doctor_status (Request $request){
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $data = $request->all();
        $user = User::findOrFail($data['doctor_id']);
        $experience = Experience::where('doctor_id',$request->doctor_id )->get();
        $pofile_complete = true;
        $message = '';
        if(! $user->gmc ){
            $pofile_complete = false;
            $message = 'GMC number missing';
        }elseif(! $user->mobile){
            $pofile_complete = false;
            $message = 'Mobile number missing';
        }elseif (count((array)$experience) <1){
            $pofile_complete = false;
            $message = 'Experience missing';
        }
        if($pofile_complete){
            return response()->json(['success' => $user], $this->successStatus);
        }else{
            return response()->json(['error' => $message], 401);
        }
    }

    public function reject_job (Request $request){
        $validator = Validator::make($request->all(), [
            'job_id' => 'required',
            'job_detail_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $data = $request->all();

        $job = Job::findOrFail($data['job_id']);
        $job->update(['overall_status' => 'reject']);

        $jobApply = Application::where(['job_id' => $request->job_id , 'job_detail_id' => $request->job_detail_id])->update(['status' => 0]);
        // end transaction
        return response()->json(['success' => $data], $this->successStatus);

    }

    public function forgot_pass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
//        dd(Config::get('mail'));
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        if($user){
            $token = rand(100000,999999);
            $user->update(['reset_token'=> $token]);
            $mailData['token'] = $token;

            $data['email'] = 'ehsan950@hotmail.com';
            $data['email'] = $user->email;


            GeneralHelper::sendMail('locumset@gmail.com', $data['email'], 'mail.forgot', $mailData, 'Forgot password token');
            return response()->json(['success' => $data], $this->successStatus);
        }else{
            return response()->json(['error'=> 'Invalid email'], 401);
        }

    }

    public function update_pass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'token' => 'required',
            'password' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
//        dd(Config::get('mail'));
        $data = $request->all();
        $user = User::where(['email'=> $data['email'],'reset_token' => $data['token']])->first();
        if($user){
            $user->update(['password' => bcrypt($data['password']) ]);
            return response()->json(['success' => $user], $this->successStatus);
        }else{
            return response()->json(['error'=> 'Invalid email'], 401);
        }

    }

    public function update_profile(Request $request)
    {

        $data = $request->all();
        $data['doctor_id'] =  Auth::user()->id;
        $user = User::where(['id'=> $data['doctor_id']])->first();
        $update_array = array();
        if(isset($data['phone'])){
            $update_array['mobile'] =$data['phone'];
        }
        if(isset($data['address'])){
            $update_array['address'] = $data['address'];
        }
        if(isset($data['hospital_id'])){
            $update_array['doc_hospital'] = $data['hospital_id'];
        }
        if(isset($data['dept_id'])){
            $update_array['doc_dept'] = $data['dept_id'];
        }

        if($user){

            $user->update($update_array);
            $user->doc_hosp_name = $user->hosp_name->name;
            $user->doc_dept_name = $user->dep_name->name;
            $user->id_image = $user->id_image ?  url('/public/uploads/doctors/'. $user->id_image) : null;
            return response()->json(['success' => $user], $this->successStatus);
        }else{
            return response()->json(['error'=> 'Invalid user'], 401);
        }

    }

    public function cancelJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required',
            'job_detail_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        //1- Check for job status, if hired generate notification
        //if not simply cancel
        //2- CHeck if date is in past dont let him cancel
        $job = Job::where('id', $request->job_id)->first();
        // check for already applied
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $jobApply = Application::where(['job_id' => $request->job_id , 'job_detail_id' => $request->job_detail_id])->update(['status' => 0]);
        $success['job_application'] =  $jobApply;

        return response()->json(['success'=>$success], $this->successStatus);
    }


    public function completedJobs(Request $request)
    {
        $completed_array = ['timesheet', 'notify',  'approved','payroll'];
        $user_id = Auth::user()->id;
        $Jobs =  Job::selectRaw('job.*, timesheet.detail_id detail_id , timesheet.time_from timesheet_time_from , timesheet.time_to timesheet_time_to')
            ->join('timesheet', 'timesheet.job_id', '=', 'job.id')
            ->where('timesheet.users_id', $user_id)
            ->whereIn('job.overall_status',$completed_array)
            ->get();

        $jobs_listings= array();

        foreach ($Jobs as $key => $value){

            if(isset($value->detail_id)){


                $detail = jobDetail::where('id', $value->detail_id)->first();

                $temp_job['id'] = $value->id;
                $temp_job['hospital_id'] = $value->hospital_id;
                $temp_job['departments_id'] = $value->departments_id;
                $temp_job['users_id'] = $value->users_id;
                $temp_job['time_from'] = date('H:i', strtotime($value->time_from)) ;
                $temp_job['time_to'] = date('H:i', strtotime($value->time_to)) ;
                $temp_job['description'] = $value->description;
                $temp_job['title'] = $value->title;
                $temp_job['date'] = date("d/m/Y", strtotime($value->date)) ;// mark as urgent based on post date
                $temp_job['num_of_grades'] = $value->num_of_grades;
                $temp_job['overall_status'] = $value->overall_status;
                $temp_job['status'] = $value->status;
                $temp_job['hospital_name'] = $value->hosp_name->name;
                $temp_job['detail_id'] = $value->detail_id;
                $temp_job['grade_id'] = $detail->grade_id;
                $temp_job['grade_name'] = $detail->grade_name->name;
                $temp_job['grade_time_from'] =  date('H:i', strtotime($detail->time_from));
                $temp_job['grade_time_to'] = date('H:i', strtotime($detail->time_to));
                $temp_job['rate'] = $detail->rate;
                $temp_job['timesheet_time_from'] =  date('H:i', strtotime($value->timesheet_time_from));
                $temp_job['timesheet_time_to'] = date('H:i', strtotime($value->timesheet_time_to));

                array_push($jobs_listings,$temp_job);
            }
        }

        return response()->json(['success'=>$jobs_listings], $this->successStatus);
    }


    public function hiredJobs(Request $request)
    {
        $user_id = Auth::user()->id;

        $Jobs =  Job::selectRaw('job.*, applications.job_detail_id detail_id')
            ->join('applications', 'applications.job_id', '=', 'job.id')
            ->where('applications.user_id', $user_id)
            ->where('applications.status', 2)
            ->where('job.overall_status','hire')
            ->get();

        $jobs_listings= array();

        foreach ($Jobs as $key => $value){

            $detail = jobDetail::where('id', $value->detail_id)->first();

            $temp_job['id'] = $value->id;
            $temp_job['hospital_id'] = $value->hospital_id;
            $temp_job['departments_id'] = $value->departments_id;
            $temp_job['users_id'] = $value->users_id;
            $temp_job['time_from'] = date('H:i', strtotime($value->time_from)) ;
            $temp_job['time_to'] = date('H:i', strtotime($value->time_to)) ;
            $temp_job['description'] = $value->description;
            $temp_job['title'] = $value->title;
            $temp_job['date'] = date("d/m/Y", strtotime($value->date)) ;// mark as urgent based on post date
            $temp_job['num_of_grades'] = $value->num_of_grades;
            $temp_job['status'] = $value->status;
            $temp_job['hospital_name'] = $value->hosp_name->name;
            $temp_job['detail_id'] = $value->detail_id;
            $temp_job['grade_id'] = $detail->grade_id;
            $temp_job['grade_name'] = $detail->grade_name->name;
            $temp_job['grade_time_from'] =  date('H:i', strtotime($detail->time_from));
            $temp_job['grade_time_to'] = date('H:i', strtotime($detail->time_to));
            $temp_job['rate'] = $detail->rate;

            array_push($jobs_listings,$temp_job);
        }

        return response()->json(['success'=>$jobs_listings], $this->successStatus);
    }



    public function hiredDetail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'job_id' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $jobs = Job::where('id', $request->job_id)->first();
        $job_detail = Jobdetail::where('job_id', $request->job_id)->get();
//        $appllied = Application::where(['job_id' => $request->job_id, 'user_id' => Auth::user()->id])->whereIn('status' , [1,2] )->get();
        $appllied = Application::where(['job_id' => $request->job_id, 'user_id' => Auth::user()->id , 'status' => 2])->first();
        $job_array = array();
        foreach ($job_detail as $key => $value){
            $temp_array['id'] = $value->id;
            $temp_array['job_id'] = $value->job_id;
            $temp_array['grade_id'] = $value->grade_id;
            $temp_array['time_to'] = date('H:i', strtotime($value->time_to));
            $temp_array['time_from'] = date('H:i', strtotime($value->time_from));
            $temp_array['rate'] = $value->rate;
            $temp_array['grade_name'] = $value->grade_name->name;
            $temp_array['is_hired'] = isset($appllied) && $appllied->job_detail_id == $value->id ? 1 : 0;
            array_push($job_array, $temp_array);
        }

        $job_info['id'] = $jobs->id;
        $job_info['hospital_id'] = $jobs->hospital_id;
        $job_info['departments_id'] = $jobs->departments_id;

        $job_info['hospital_name'] = $jobs->hosp_name->name;
        $job_info['department_name'] = $jobs->dep_name->name;

        $job_info['hire_status'] = $jobs->hire_status;
        $job_info['overall_status'] = $jobs->overall_status;
        $job_info['time_from'] = date('H:i', strtotime($jobs->time_from));
        $job_info['time_to'] = date('H:i', strtotime($jobs->time_to));

        $job_info['description'] = $jobs->description;
        $job_info['title'] = $jobs->title;
        $job_info['date'] = date("d/m/Y", strtotime($jobs->date));
        $job_info['num_of_grades'] = $jobs->num_of_grades;
        $job_info['job_detail_id'] = isset($appllied) ? $appllied->job_detail_id  : '';

        $success['data'] =  $job_info;
        $success['data_detail'] =  $job_array;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function save_settings(Request $request)
    {

        $user = User::findOrFail(Auth::user()->id);
        $input = $request->all();
        $user->update($input);
        $user->image_path =  url('/public/uploads/doctors/'. $user->image);
        $user->id_image =  url('/public/uploads/doctors/'. $user->id_image);
        return response()->json(['success'=>$user], $this->successStatus);
    }

    public function history(Request $request)
    {
        $user_id = Auth::user()->id;
        $Jobs =  Job::selectRaw('job.*, applications.job_detail_id detail_id')
            ->join('applications', 'applications.job_id', '=', 'job.id')
            ->where('applications.user_id', $user_id)
            ->where('applications.status', 2)
            ->where('job.overall_status','payment')
            ->get();

        $jobs_listings= array();
        $total = 0;
        foreach ($Jobs as $key => $value){

            $detail = jobDetail::where('id', $value->detail_id)->first();

            $temp_job['id'] = $value->id;
            $temp_job['hospital_id'] = $value->hospital_id;
            $temp_job['departments_id'] = $value->departments_id;
            $temp_job['users_id'] = $value->users_id;
            $temp_job['time_from'] = date('H:i', strtotime($value->time_from)) ;
            $temp_job['time_to'] = date('H:i', strtotime($value->time_to)) ;
            $temp_job['description'] = $value->description;
            $temp_job['title'] = $value->title;
            $temp_job['date'] = date("d/m/Y", strtotime($value->date));
            $temp_job['day'] = date('d', strtotime($value->date));
            $temp_job['month_year'] = date('M y', strtotime($value->date));


            $temp_job['num_of_grades'] = $value->num_of_grades;
            $temp_job['status'] = $value->status;
            $temp_job['hospital_name'] = $value->hosp_name->name;
            $temp_job['department_name'] = $value->dep_name->name;
            $temp_job['detail_id'] = $value->detail_id;
            $temp_job['grade_id'] = $detail->grade_id;
            $temp_job['grade_name'] = $detail->grade_name->name;
            $temp_job['grade_time_from'] =  date('H:i', strtotime($detail->time_from));
            $temp_job['grade_time_to'] = date('H:i', strtotime($detail->time_to));
            $temp_job['rate'] = $detail->rate;
            $total += $detail->rate;
            array_push($jobs_listings,$temp_job);
        }

        $resp_array['jobs_data'] = $jobs_listings;
        $resp_array['total'] = $total;

        return response()->json(['success'=>$resp_array], $this->successStatus);
    }

    public function paymentStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $data = $request->all();
        $job = Job::where('id', $data['job_id'])->first();

        $job->update(['overall_status' => 'payment']);
        return response()->json(['success'=> 'Status saved successfully'], $this->successStatus);
    }

    public function get_doc_profile (Request $request){
//        $user = Auth::user()->id;
        $user = User::find(Auth::user()->id);
        $user->image_path = $user->image ?  url('/public/uploads/doctors/'. $user->image) : null;
        $user->id_image = $user->id_image ?  url('/public/uploads/doctors/'. $user->id_image) : null;
        $user->doc_hosp_name = $user->hosp_name->name;
        $user->doc_dept_name = $user->dep_name->name;
        return response()->json(['success' => $user], $this->successStatus);

    }

    public function myCalendar(Request $request)
    {
        //calendar is combination of two types of job (hired and appllied)

        $user_id = Auth::user()->id;
//        if(isset($request->month))
        $hiredJobs =  Job::selectRaw('job.*, applications.job_detail_id detail_id')
            ->join('applications', 'applications.job_id', '=', 'job.id')
            ->where('applications.user_id', $user_id)
            ->where('applications.status', 2)
            ->where('job.overall_status','hire')
            ->get();

        $appliedJobs =  Job::selectRaw('job.*, applications.job_detail_id detail_id')
            ->join('applications', 'applications.job_id', '=', 'job.id')
            ->where('applications.user_id', $user_id)
            ->where('applications.status', 1)
            ->where('job.overall_status','publish')
            ->get();

        $hired_jobs_listings = array();
        $applied_jobs_listings = array();
        foreach ($hiredJobs as $key => $value){

            $temp_job['date'] = $value->date;
            array_push( $hired_jobs_listings, $value->date );
        }

        foreach ($appliedJobs as $key => $value){

            $temp_job['date'] = $value->date;
            array_push($applied_jobs_listings , $value->date);
        }

        $merged_array = array_unique (array_merge($applied_jobs_listings, $hired_jobs_listings));

        // for every sunday make starting day true, and for every saturday make ending day true

        $response_array =  array();

        foreach ($merged_array as $val){
            $after_date = date('Y-m-d', strtotime($val . ' +1 day'));
            $before_date = date('Y-m-d', strtotime($val . ' -1 day'));
            $startingDay = true;
            $endingDay = true;
            if(in_array($before_date, $merged_array)){
                $startingDay = false;
                //check if day is SUNDAY make it true
                if( date('l', strtotime($val)) == 'Sunday'){
                   $startingDay = true;
               }

            }
            if(in_array($after_date, $merged_array)){
                $endingDay = false;
                //check if day is SATURDAY make it true
                if( date('l', strtotime($val)) == 'Saturday'){
                    $endingDay = true;
                }

            }
            if(in_array($val, $hired_jobs_listings)){
                $response_array[''.$val.''] = array(
                    'startingDay' => $startingDay,
                    'endingDay' => $endingDay,
                    'color' => '#c2e3f6'

                );
            }elseif (in_array($val, $applied_jobs_listings)){
                $response_array[''.$val.''] = array(
                    'startingDay' => $startingDay,
                    'endingDay' => $endingDay,
                    'color' => '#fbd1d3'
                );
            }
        }

//
//        markedDates={{
//        '2012-05-14': {startingDay: true, color: '#c2e3f6', endingDay: true},
//                      '2012-05-21': {startingDay: true, color: '#c2e3f6'},
//                      '2012-05-22': {endingDay: true, color: '#fbd1d3'},
//                      '2012-05-24': {startingDay: true, color: '#c2e3f6'},
//                      '2012-05-26': {endingDay: true, color: '#fbd1d3'},
//                      '2012-06-14': {startingDay: true, color: '#c2e3f6'},
//                      '2012-06-21': {startingDay: true, color: '#c2e3f6'},
//                      '2012-06-22': {endingDay: true, color: '#fbd1d3'},
//                      '2012-06-24': {startingDay: true, color: '#c2e3f6'},
//                      '2012-06-26': {endingDay: true, color: '#fbd1d3'},
//                    }}


        return response()->json(['success' => $response_array], $this->successStatus);

    }
}
