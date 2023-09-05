<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\PermissionHelper;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Projects\StoreUpdateRequest;
use App\Http\Requests\Admin\StoreUserProjectRequest;

use Spatie\Permission\Models\Role;
// use Excel;
use App\User;
use App\Models\Admin\Projects;
use App\Models\Admin\Unittype;

use App\Models\Admin\ProjectDays;
use App\Models\Admin\UnitCalls;
use App\Models\Admin\CastCalls;
use App\Models\Admin\ShootingSchedule;
use App\Models\Admin\RecceNotes;
use App\Models\Admin\UserProjects;
use App\Models\Admin\RolePermission;

use Auth;
use DB;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;


class ProjectController extends Controller
{

    public function show($id)
    {

//in_use
        // if (!Gate::allows('Project_view')) {
        //     return abort(401);
        // }

        $Project = Projects::findOrFail($id);
        $ProjectDays = ProjectDays::where('project_id', $id)->get();
        $UnitCalls = UnitCalls::where('project_id', $id)->get();
        $CastCalls = CastCalls::where('project_id', $id)->get();
        $Schedule = ShootingSchedule::where('project_id', $id)->get();
        $UnitCalls = json_decode(json_encode($UnitCalls), true);
        
        // dd('ok',$Project,$ProjectDays);

        return view('admin.projects.detail', compact('Project','ProjectDays', 'UnitCalls', 'CastCalls', 'Schedule'));

    }
 

    /**
     * Display a listing of Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //in_use

        // if (! Gate::allows('Project_manage')) {
        //     return abort(401);
        // }

        $user = Auth::user();
        $perm =  array();
        $userProjects = array();
        if($user->name != 'Admin'){
            
            $userProjects = PermissionHelper::getuserProjects($user->id);
            $project_ids = array_keys($userProjects);
            $role_ids = array_values($userProjects);
            $role_ids = array_unique($role_ids);
            $perm = RolePermission::whereIn('id',$role_ids)->pluck('permissions','id');
            $Projects = Projects::whereIn('id', $project_ids)->get();
            
            
        }else{
            $Projects = Projects::all();    
        }


        return view('admin.projects.index', compact('Projects','userProjects','perm','user'));

    }


    /**
     * Show the form for creating new Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //in_use
        // if (! Gate::allows('Project_create')) {
        //     return abort(401);
        // }
        // dd('ok');
        
        return view('admin.projects.create');
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param  \App\Http\Requests\Admin\Project\StoreUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRequest $request)
    {
        //in_use
        // if (! Gate::allows('Project_create')) {
        //     return abort(401);
        // }

        $userarray = [];
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        // dd($data);
        Projects::create($data);

        flash('Record has been created successfully.')->success()->important();

        return redirect()->route('admin.projects.index');
    }


    /**
     * Show the form for editing Project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        $Project = Projects::findOrFail($id);
        
        return view('admin.projects.edit', compact('Project'));
    }

    /**
     * Update Project in storage.
     *
     * @param  \App\Http\Requests\Admin\Project\StoreUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRequest $request, $id)
    {
        //in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        
        $Project = Projects::findOrFail($id);

        $data = $request->all();

        $data['updated_by'] = Auth::user()->id;

        $data['updated_at'] = \Carbon\Carbon::now();
        
        $Project->update($data);

        flash('Record has been updated successfully.')->success()->important();

        return redirect()->route('admin.projects.index');
    }


    /**
     * Remove Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('Project_destroy')) {
            return abort(401);
        }
        $Project = Project::findOrFail($id);
        $Project->delete();

        flash('Record has been deleted successfully.')->success()->important();

        return redirect()->route('admin.Project.index');
    }

    /**
     * Activate Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        if (! Gate::allows('Project_active')) {
            return abort(401);
        }

        $Project = Project::findOrFail($id);
        $user = User::findOrFail($Project->user->id);
        $user->update(['active' => 1]);
        $Project->update(['status' => 1]);

        flash('Record has been activated successfully.')->success()->important();

        return redirect()->route('admin.Project.index');
    }

    /**
     * Inactivate Project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive($id)
    {

        if (! Gate::allows('Project_inactive')) {
            return abort(401);
        }

        $Project = Project::findOrFail($id);

        $user = User::findOrFail($Project->user->id);
        $user->update(['active' => 0]);
        $Project->update(['status' => 0]);

        flash('Record has been inactivated successfully.')->success()->important();

        return redirect()->route('admin.Project.index');
    }

    /**
     * Delete all selected Project at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('Project_mass_destroy')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Project::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
    
    public function user_projects()
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
// dd('user project');
        $UserProjects = UserProjects::all();
        //dd($UserProjects);
        return view('admin.user_projects.index', compact('UserProjects'));

    }

    public function create_user_projects()
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        // dd('user project');
        $Users = User::where('active',1)->where('id' ,'<>',1)->pluck('name','id');
        $Projects = Projects::pluck('name','id');
        $Projects->prepend('Select a Project', '');
        $roles = Role::where('name','<>', 'administrator')->get()->pluck('name', 'id');
        $Users->prepend('Select a User', '');
        $Projects->prepend('Select a Project', '');
        $roles->prepend('Select a Role', '');
        return view('admin.user_projects.user_projects', compact('Users','Projects','roles'));

    }

    public function store_user_projects(StoreUserProjectRequest $request)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        // dd('user project');

        $data= $request->all();
        $user_id = $data['user_id'];
        $project_id = $data['project_id'];

        $user_project_count = UserProjects::where(['user_id' => $user_id , 'project_id' =>$project_id ])->count();
        if($user_project_count > 0){
            // return back with input
            flash('User already exists in the same project.')->error()->important();
            return redirect()->route('admin.projects.create_user_projects' );

        }

        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;

        UserProjects::create($data);

        flash('Record has been created successfully.')->success()->important();
        return redirect()->route('admin.projects.user_projects' );

    }


    public function edit_user_projects($id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        // dd('user project');

        $UserProjects = UserProjects::where('id', $id)->first();
        // dd($UserProjects);

        $Users = User::where('active',1)->where('id' ,'<>',1)->pluck('name','id');
        $Projects = Projects::pluck('name','id');
        $roles = Role::where('name','<>', 'administrator')->get()->pluck('name', 'id');

        return view('admin.user_projects.edit_user_projects', compact('UserProjects','Users','Projects','roles'));

    }


    public function update_user_projects(StoreUserProjectRequest $request, $id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        // dd('user project');
        $UserProjects = UserProjects::findOrFail($id);
        $data= $request->all();
        
        $user_id = $data['user_id'];
        $project_id = $data['project_id'];

        $user_project_count = UserProjects::where(['user_id' => $user_id , 'project_id' =>$project_id ])->where('id', '<>',$id)->count();
        // dd($user_project_count);
        if($user_project_count > 0){
            // return back with input
            flash('User already exists in the same project.')->error()->important();
            return redirect()->route('admin.projects.create_user_projects' );

        }

        $data['updated_by'] = Auth::user()->id;

        $UserProjects->update($data);

        flash('Record has been updated successfully.')->success()->important();
        return redirect()->route('admin.projects.user_projects' );

    }


     public function delete_user_projects( $id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        // dd('user project');
        $UserProjects = UserProjects::findOrFail($id);
        // dd($UserProjects);
        $data['deleted_by'] = Auth::user()->id;

        $UserProjects->update($data);
        $UserProjects->delete();

        flash('Record has been updated successfully.')->success()->important();
        return redirect()->route('admin.projects.user_projects' );

    }




    public function unit_calls($id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }

        $UnitCalls = UnitCalls:: where('project_id', $id)->get();

        $Project = Projects::findOrFail($id);
        
        return view('admin.projects.unit_calls', compact('UnitCalls','Project'));

    }

    public function get_unit_data(Request $request)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        $data = $request->all();
        $Unittype = Unittype::pluckUnitTypes();
        $UnitCalls = UnitCalls:: where(['project_id'=> $data['project_id'], 'day_no'=> $data['day_no']])->get();
        $res['Unittype'] = $Unittype;
        $res['UnitCalls'] = $UnitCalls;

        return response()->json($res);
    
    }

    

    public function update_unit_calls(Request $request,$id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }

        $data = $request->all();
        $day_no = $data['unit_day_no'];

        UnitCalls:: where(['project_id'=> $id, 'day_no' => $day_no])->delete();

        $unit_lineitems=array();
        $line_items_array_start = $data['unit_line_items']['unit_type'];
        
        foreach ($line_items_array_start as $key => $val) {
            if($key != '######'){

                $temp_data = array(
                        'project_id' => $id,
                        'day_no' => $day_no,
                        'unit_type' => $data['unit_line_items']['unit_type'][$key],
                        'time' => $data['unit_line_items']['time'][$key],
                        
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    );

                    array_push($unit_lineitems, $temp_data);
            }

        }


        UnitCalls::insert($unit_lineitems);
       
        return redirect()->route('admin.projects.schedule', ['id' => $id] );

    }

 

    public function project_cast_call($id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        // dd('ok');

        $CastCalls = CastCalls:: where('project_id', $id)->get();

        $Project = Projects::findOrFail($id);

        return view('admin.projects.cast_call_detail', compact('CastCalls','Project'));

    }

     public function get_cast_data(Request $request)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        $data = $request->all();

        $CastCalls = CastCalls:: where(['project_id'=> $data['project_id'], 'day_no'=> $data['day_no']])->get();

        return response()->json($CastCalls);
    
    }

    public function update_project_cast_call(Request $request, $id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }

        $data = $request->all();
        // dd($data);
        $day_no = $data['cast_day_no'];
        $Project = Projects::find($id);

        CastCalls:: where(['project_id'=> $id, 'day_no' => $day_no])->delete();

        $cast_lineitems=array();
        $line_items_array_start = $data['cast_line_items']['name'];

        foreach ($line_items_array_start as $key => $val) {
            if($key != '######'){

                $temp_data = array(
                        'project_id' => $id,
                        'day_no' => $day_no,
                        'name' => $data['cast_line_items']['name'][$key],
                        'artist_name' => $data['cast_line_items']['artist_name'][$key],
                        'call_time' => $data['cast_line_items']['call_time'][$key],
                        'call_to' => $data['cast_line_items']['call_to'][$key],
                        's_by' => $data['cast_line_items']['s_by'][$key],
                        'screen_notes' => $data['cast_line_items']['screen_notes'][$key],
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    );

                    array_push($cast_lineitems, $temp_data);
            }

        }

        CastCalls::insert($cast_lineitems);

        return redirect()->route('admin.projects.schedule', ['id' => $id]);

    }

    public function project_schedule($id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
    
        $ShootingSchedule = ShootingSchedule:: where('project_id', $id)->get();


        $Project = Projects::findOrFail($id);
        $ProjectDays = ProjectDays:: where('project_id', $id)->orderBy('day_no', 'asc')->get();
        $days_info = array();
// dd($ProjectDays);
        foreach ( $ProjectDays as $val ) {
            $days_info[$val->day_no] =  $val;
        }

        $Unittype = Unittype::pluckUnitTypes();

        // dd($days_info[1]->day_date);        

        return view('admin.projects.schedule_detail', compact('ShootingSchedule','Project', 'ProjectDays','days_info','Unittype'));

    }

    public function update_project_schedule(Request $request,$id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        $data = $request->all();
//         dd($data);
        ShootingSchedule:: where(['project_id'=> $id, 'day_no' => $data['schedule_day_no']])->delete();
        $day_no = $data['schedule_day_no'];

        $shooting_lineitems=array();
        $line_items_array_start = $data['schedule_line_items']['duration'];
        
        foreach ($line_items_array_start as $key => $val) {
             if($key != '######'){

                if(isset( $data['schedule_line_items']['file_location'][$key] ) && ! is_string ($data['schedule_line_items']['file_location'][$key])){
                    
                    $file_name = $data['schedule_line_items']['file_location'][$key]->getClientOriginalName();
                    // $file_name = $data['schedule_line_items']['file_location'][$key];
                    // dd($file_name);
                    $file_new_name = time().'_'.str_replace('-', '_', str_replace(' ','_', $file_name));
                    $destinationPath = 'public/uploads/schedule';
                    $data['schedule_line_items']['file_location'][$key]->move($destinationPath, $file_new_name);
                    $data['schedule_line_items']['file_location'][$key] = $destinationPath.'/'.$file_new_name;
                }

                $temp_data = array(
                        'project_id' => $id,
                        'day_no' => $day_no,
                        'duration' => $data['schedule_line_items']['duration'][$key],
                        'scene' => $data['schedule_line_items']['scene'][$key],
                        'camera' => $data['schedule_line_items']['camera'][$key],
                        'cast' => $data['schedule_line_items']['cast'][$key],
                        'art' => $data['schedule_line_items']['art'][$key],
                        'short_desc' => $data['schedule_line_items']['short_desc'][$key],
                        'screen_notes' => $data['schedule_line_items']['screen_notes'][$key],

                        'image' => isset($data['schedule_line_items']['file_location'][$key]) ? $data['schedule_line_items']['file_location'][$key] : '',
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    );

                    array_push($shooting_lineitems, $temp_data);
            }

        }


        ShootingSchedule::insert($shooting_lineitems);
       
        return redirect()->route('admin.projects.schedule', ['id' => $id] );

    }

    public function project_recce($id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        $Project = Projects::findOrFail($id);
        $recceNotes = RecceNotes:: where('project_id', $id)->get();
//        dd('under development', $recceNotes);
        
        return view('admin.projects.recce_detail', compact('recceNotes','Project'));

    }
    
    public function update_project_recce(Request $request,$id)
    {
        // in_use
        // if (! Gate::allows('Project_edit')) {
        //     return abort(401);
        // }
        $data = $request->all();
//        dd($data );
        RecceNotes:: where(['project_id'=> $id])->delete();
//        dd( implode(",",$data['recce_line_items']['day_no']['2']));
        $recce_lineitems=array();
        $line_items_array_start = $data['recce_line_items']['duration'];

        foreach ($line_items_array_start as $key => $val) {
            if($key != '######'){

                if(isset( $data['recce_line_items']['file_location'][$key] ) && ! is_string ($data['recce_line_items']['file_location'][$key])){

                    $file_name = $data['recce_line_items']['file_location'][$key]->getClientOriginalName();
                    // $file_name = $data['recce_line_items']['file_location'][$key];
                    // dd($file_name);
                    $file_new_name = time().'_'.str_replace('-', '_', str_replace(' ','_', $file_name));
                    $destinationPath = 'public/uploads/schedule';
                    $data['recce_line_items']['file_location'][$key]->move($destinationPath, $file_new_name);
                    $data['recce_line_items']['file_location'][$key] = $destinationPath.'/'.$file_new_name;
                }

                $temp_data = array(
                    'project_id' => $data['project_id'],
                    'day_no' => isset( $data['recce_line_items']['day_no'][$key] ) ? implode("," , $data['recce_line_items']['day_no'][$key]) : '',
                    'duration' => $data['recce_line_items']['duration'][$key],
                    'location' => $data['recce_line_items']['location'][$key],
                    'scene' => $data['recce_line_items']['scene'][$key],
                    'camera' => $data['recce_line_items']['camera'][$key],
                    'cast' => $data['recce_line_items']['cast'][$key],
                    'art' => $data['recce_line_items']['art'][$key],
                    'short_desc' => $data['recce_line_items']['short_desc'][$key],
                    'screen_notes' => $data['recce_line_items']['screen_notes'][$key],
                    'image' => isset($data['recce_line_items']['file_location'][$key]) ? $data['recce_line_items']['file_location'][$key] : '',

                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                );

                array_push($recce_lineitems, $temp_data);
            }

        }


        RecceNotes::insert($recce_lineitems);
        flash('Recce Notes has been added successfully.')->success()->important();
        return redirect()->route('admin.projects.index' );

    }

    public function save_day(Request $request)
    {
            // dd('ok');
        $data = $request->all();
        
        $project_id = $data['project_id'];
        $day_no = $data['day_no'];
        $response['status'] = false;
        $projectDays = ProjectDays::where(['project_id' => $project_id, 'day_no'=>$day_no])->first();

        if($projectDays){
            $data['updated_by'] = Auth::user()->id;
            $projectDays->update($data);
            $response['status'] = true;
            $response['op'] = 'update';

        }else{

            $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;
            ProjectDays::create($data);
            $response['status'] = true;
            $response['op'] = 'create';
            
        }

        return response()->json($response);
        // dd($data);
    }

    public function get_schedule_data(Request $request){

        $data = $request->all();

        $ShootingSchedules = ShootingSchedule:: where(['project_id'=> $data['project_id'], 'day_no'=> $data['day_no']])->get();

        return response()->json($ShootingSchedules);
    }

    public function get_recce_data(Request $request){

        $data = $request->all();

        $RecceNotes = RecceNotes:: where(['project_id'=> $data['project_id'] ])->get();

        return response()->json($RecceNotes);
    }




}
