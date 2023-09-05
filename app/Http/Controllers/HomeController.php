<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobRequest;
use App\Http\Requests\Admin\UpdateJobRequest;

use App\Models\Admin\Grade;

use Illuminate\Support\Facades\Gate;
use App\Models\Admin\RolePermission;
use App\Helpers\PermissionHelper as Per;
use App\Helpers\GeneralHelper;
use App\Models\Admin\Departments;
use App\Models\Admin\Hospital;
use App\Models\Admin\Jobdetail;
use App\Models\Admin\Job;
use App\Models\Admin\Application;
use App\User;
use Auth;
use Config;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Counts = array(
            'job' => 0,
            'admins'=> 0,
            'hospitals'=> 0,

        );
        $logged_in = Auth::user();
        $archive_array = ['close', 'expire'];

//        GeneralHelper::sendGCM(['abc'],'Test','test');
        //
//        $token = 'fn1hoiE86tv166W4NeyrUd:APA91bEyhYMKNGB--k4LRzMJ4IwmrQv8ZUov2rXSMzHbWho_Xmm1hBySZbQsnr-DW03Lw3GPUHiQ_FIXOOmOfq1en7Yuqyo4z25TBNUYiYJKSZSEugzxczuYDRj73smD94JY31zfd6zh';
//        GeneralHelper::sendWeb($token,'New Job Application', 'You have new application on the job','http://rms.socialtypingtest.com/admin/application');

        $Jobs_application =  Application::selectRaw('job.title,job.time_to,job.time_from, job.date job_date ,  job_id, COUNT(applications.id) apps')
            ->join('job', 'applications.job_id', '=', 'job.id')

            ->where(['dept_id' => $logged_in->dept_id])
             ->where('applications.status', 1)
            ->where('job.overall_status','publish')
            ->groupBy('job_id','title','date','time_from','time_to')
            ->get();
            // dd($Jobs_application);

            $notapply = Application::where('status',0)->get();
          
            $Jobs_details =  Application::selectRaw('job.title, job.date job_date ,  job_id, COUNT(applications.id) apps')
            ->join('job', 'applications.job_id', '=', 'job.id')
            ->where(['dept_id' => $logged_in->dept_id])
            ->where('applications.status', 2)
            ->where('job.overall_status','hire')
            ->groupBy('job_id','title','date')
            ->get();
            $jobs_id = array();
            foreach($Jobs_details as $jobs_app)
            {
                $jobs_id[] = $jobs_app['job_id'];
            }
            $Applicants = Application::whereIn('job_id',$jobs_id)->where('status',2)->get();
        $details_array = array();
        foreach($Applicants as $key => $apps){
            $temp_users['user_id'] = $apps->user_id;
            $temp_users['app_id'] = $apps->id;
            $temp_users['name'] = $apps->user_name->name;
            $temp_users['gmc'] = $apps->user_name->gmc;
            $temp_users['email'] = $apps->user_name->email;
            $temp_users['mobile'] = $apps->user_name->mobile;
            $temp_users['grade'] = $apps->detail_name->grade_name->name;
            $temp_users['job_id'] = $apps->job_name->title;
            $temp_users['job_date'] = $apps->job_name->date;
            $temp_users['job_timeTo'] = $apps->job_name->time_to;
            $temp_users['job_timeFrom'] = $apps->job_name->time_from;
            $temp_users['job_grade'] = $apps->detail_name->grade_name->name;

            array_push($details_array, $temp_users);
        }
        
        if($logged_in->role_id == 2){
            $archive_array = ['close', 'expire'];
            $dep = Departments::where(['id'=>$logged_in['dept_id']])->get('name');
            $hosp = Hospital::where(['id'=>$logged_in['hospital_id']])->get('name');
            $Counts['job'] = Job::where(['departments_id'=> $logged_in->dept_id])->where('overall_status','publish')->orderby  ('created_at')->count();
            $Counts['approved_shifts'] = Job::where(['departments_id'=> $logged_in->dept_id])->where('overall_status','hire')->orderby  ('created_at')->count();
            $Counts['cancel_shifts'] = Application::where(['dept_id'=> $logged_in->dept_id])->where('status',0)->orderby  ('created_at')->count();
            $Counts['completed_shifts'] = Job::where(['departments_id'=> $logged_in->dept_id])->where('overall_status','payment')->orderby  ('created_at')->count();

            $Jobs = Job::where(['departments_id'=> $logged_in->dept_id])->orderby('created_at')->get()  ;
            $events = Job::where(['departments_id'=> $logged_in->dept_id])->orderby('created_at')->get();
            $Counts['admins'] = User::count();
            $Counts['hospitals'] = Hospital::count();

           
           
        }else{
            $Jobs = Job::orderby('created_at')->get();
            $events = Job::orderby('created_at')->get();
            $Counts['job'] = Job::count();
            $Counts['admins'] = User::count();
            $Counts['hospitals'] = Hospital::count();

        }
       $event_list = [];
       
       foreach($events as $key => $event){

        $event_list[]= \Calendar::event(
        $event->title,
        true,
        new \DateTime($event->date),
        new \DateTime($event->date),
            $event->id,
            [
                'color' => 'orange',
            ]
        );
       } 
       $calendar_details = \Calendar::addEvents($event_list);

        $grades = Grade::pluck('name', 'id');
        $grades->prepend('Select a grade','');
        $job = Job::where('status',2)->get();
        foreach($job as $jobs){
            $date = $jobs['date'];
            $title = $jobs['title'];
        }
//        $curr_Date = Date('Y-m-d');
//        $job_date = date('Y-m-d', strtotime($curr_Date. ' + 20 days'));

        $curr_Date = Date('Y-m-d');

        $job_date = date('d/m/Y', strtotime($curr_Date. ' + 1 days'));
        return view('index', compact('grades','calendar_details','job_date','Jobs','logged_in','Counts','Jobs_application','details_array'));
    }

    public function addEvents(Request $request){
        $job = Job::where('status',2)->get(); 
        foreach($job as $jobs){
            $date = $jobs['date'];
            $title = $jobs['title'];
        }
        $event = new Event;
        $event->title = $title;
        $event->date = $date;
        $event->color = #3a87ad;

        
        $event->save();
        return Reirect::to('index');
    }
    public function applicants($job_id){
        $Applicants = Application::where('job_id',$job_id)->get();
      
        $response_array = array();
        foreach($Applicants as $key => $apps){
            $users['user_id'] = $apps->user_id;
            $users['app_id'] = $apps->id;
            $users['name'] = $apps->user_name->name;
            $users['gmc'] = $apps->user_name->gmc;
            $users['email'] = $apps->user_name->email;
            $users['mobile'] = $apps->user_name->mobile;
            $users['grade'] = $apps->detail_name->grade_name->name;
            $users['job_id'] = $job_id;

            array_push($response_array, $users);
        }

        return response()->json($response_array);
    }

    public function admin_token($token){
//        dd('ok');
        $user_id = Auth::user()->id;
        User::where('id', $user_id)->update(['device_token' => $token ]);
        return response()->json( ['result' => true] );
    }

}



