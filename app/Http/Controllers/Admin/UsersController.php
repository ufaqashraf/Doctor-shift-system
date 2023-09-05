<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Admin\Projects;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Models\Admin\UserProjects;
use App\Models\Admin\RolePermission;
use App\Models\Admin\Departments;
use App\Models\Admin\Experience;
use App\Helpers\PermissionHelper as Per;
use Session;
use Auth;
use DB;
use App\Models\Admin\Hospital;
use App\Helpers\GeneralHelper;
use App\Models\Admin\UserDevices;

class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (! Per::has_permission('users_manage')) {
            return abort(401);
        }

        $users = User::where('role_id', 2)->get();
//    dd($users);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Per::has_permission('users_manage')) {
            return abort(401);
        }
        $roles = Role::where('name','<>', 'administrator')->get()->pluck('name', 'name');

        $Hospital = Hospital::pluck('name','id');
        $Hospital->prepend('Select a Hospital', '');
//        $dept = Departments::pluck('name','id');
        $roles->prepend('Select a Role', '');
        $Departments = Departments::pluck('name','id');
        return view('admin.users.create', compact('roles','Hospital','Departments'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if (! Per::has_permission('users_manage')) {
            return abort(401);
        }
        $data = $request->all();
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $role_name = $roles[0];
        $role_id= Role::where('name',$role_name)->first()->id;

        $perm = RolePermission::where('id', $role_id)->pluck('permissions')->first();

        $data['dept_id'] = isset($data['dept_id']) ? $data['dept_id'] : 1;
        $data['role_id'] = $role_id;
        $data['permissions'] = $perm;
        $data['password'] = bcrypt($data['password']);
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $user = User::create($data);

        session()->flash('success', 'Record has been created successfully.');
        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Per::has_permission('users_manage')) {
            return abort(401);
        }
        $roles = Role::where('name','<>', 'administrator')->get()->pluck('name', 'name');

        $Hospital = Hospital::pluck('name','id');
        $Hospital->prepend('Select a Hospital', '');


        $user = User::findOrFail($id);
        $Departments = Departments::pluck('name','id');
        $Departments->prepend('Select a Department', '');
        return view('admin.users.edit', compact('user', 'roles','Hospital','Departments'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        if (! Per::has_permission('users_manage')) {
            return abort(401);
        }
        $user = User::findOrFail($id);

        $data = $request->all();

        $roles = $request->input('roles') ? $request->input('roles') : [];
        $role_name = $roles[0];
        $role_id= Role::where('name',$role_name)->first()->id;
        $perm = RolePermission::where('id', $role_id)->pluck('permissions')->first();

        $data['role_id'] = $role_id;
        $data['permissions'] = $perm;


        if(! isset($data['password'])){
            unset($data['password']);
        }else{
            $data['password'] = bcrypt($data['password']);
        }
//        dd($data);
        $data['updated_by'] = Auth::user()->id;
        $user->update($data);
        // $roles = $request->input('roles') ? $request->input('roles') : [];
        // $user->syncRoles($roles);
        Session::flash('success', 'Record has been updated successfully.');
        return redirect()->route('admin.users.index');
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Per::has_permission('users_manage')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('success', 'Record has been deleted successfully.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Per::has_permission('users_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function get_dept_data(Request $request)
    {
        $data = $request->all();
        $dept = Departments::where('hospital_id', $data['hospital_id'])->pluck('name','id');
        return response()->json($dept);
    }

    public function doctors()
    {
        if (! Per::has_permission('users_manage')) {
            return abort(401);
        }

        $users = User::where('role_id', 3)->get();

        return view('admin.users.doctors', compact('users'));
    }
    public function profile($id)
    {
        $users = User::where('id', $id)->get();
      
        foreach($users as $user){
            $userID = $user['id'];
        }
        $experience = Experience::where('doctor_id', $userID)->get();
 
        return view('admin.users.profile', compact('users','experience'));
    }

    public function newDoctors()
    {
        // get un approved doctors
        $logged_in = Auth::user();

        $users = User::where(['role_id'=> 3, 'approved' => 0])->get();
            
        return view('admin.users.new_doctors', compact('users'));

    }

    public function change_doc_status($id, $status)
    {
        $user = User::where('id', $id)->update(['approved' => $status]);
        if($status == 1){
            session()->flash('success', 'Doctor has been approved successfully.');
        }else{
            session()->flash('success', 'Doctor has been rejected');
        }

        $tokens = UserDevices::where('user_id', $id)->pluck('device_token');

        if(count($tokens) > 0 && $status == 1){
            $title = 'Congratulation !';
            $body = 'Your profile has been approved by admin ';
            $data = array(
                'page'=>'profile'
            );
            GeneralHelper::sendGCM($tokens, $title,  $body, $data);
        }


        return redirect()->route('admin.users.new');
    }

}
