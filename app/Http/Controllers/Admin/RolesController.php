<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use App\Models\Admin\RolePermission;
use App\Helpers\PermissionHelper as Per;
use App\User;
use Auth;
use DB;
use Session;

class RolesController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (! Gate::allows('roles_manage')) {
//            return abort(401);
//        }

        $Roles = Role::all();

        return view('admin.roles.index', compact('Roles'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Per::has_permission('roles_create')) {
            return abort(401);
        }

        // Get list of all allowed permissions for current role.
        $AllowedPermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->get()->pluck('name', 'id');
        if(!$AllowedPermissions) {
            $AllowedPermissions = [];
        }

        $GroupPermissions = Permission::where(['main_group' => 1])->get()->toArray();
        $SubPermissions = Permission::whereIn('parent_id', Permission::where(['main_group' => 1])->pluck('id'))->get()->toArray();

        return view('admin.roles.create', compact('GroupPermissions', 'SubPermissions', 'AllowedPermissions'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolesRequest $request)
    {
//        if (! Gate::allows('roles_create')) {
//            return abort(401);
//        }
        $data = $request->all();
//        dd($data);
        $role = Role::create($request->except('permission'));
        
        $permissions = $request->input('permission') ? $request->input('permission') : [];
    
        $per_data['id'] = $role->id;
        $per_data['role_name'] = $data['name'];
        $per_data['permissions'] = implode(',', $permissions);
        $per_data['created_by'] = Auth::user()->id;
        $per_data['updated_by'] = Auth::user()->id;

        // dd(per_data);
        RolePermission::create($per_data);
        

        $role->givePermissionTo($permissions);

        session()->flash('success', 'Record has been created successfully.');

        return redirect()->route('admin.roles.index');
    }


    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        if (! Gate::allows('roles_edit')) {
//            return abort(401);
//        }

        $Role = Role::findOrFail($id);

        // Get list of all allowed permissions for current role.
        $AllowedPermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where(['role_has_permissions.role_id' => $Role->id])
            ->get()->pluck('name', 'id');
        if(!$AllowedPermissions) {
            $AllowedPermissions = [];
        }

        $GroupPermissions = Permission::where(['main_group' => 1])->get()->toArray();
        $SubPermissions = Permission::whereIn('parent_id', Permission::where(['main_group' => 1])->pluck('id'))->get()->toArray();

        return view('admin.roles.edit', compact('Role', 'GroupPermissions', 'SubPermissions', 'AllowedPermissions'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateRolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolesRequest $request, $id)
    {
//        if (! Gate::allows('roles_edit')) {
//            return abort(401);
//        }

        $data = $request->all();

        $role = Role::findOrFail($id);

        $role->update($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];

        $RolePermission = RolePermission::find($role->id);

        //dd($RolePermission, $data);
        $per_data['role_name'] = $data['name'];
        $per_data['permissions'] = implode(',', $permissions);
        $per_data['updated_by'] = Auth::user()->id;
        if(!$RolePermission){
            $per_data['id'] = $role->id;
            $per_data['created_by'] = Auth::user()->id;

            RolePermission::create($per_data);
        }else{
            $RolePermission->update($per_data);
        }
        $user_perm['permissions'] = implode(',', $permissions);
//        $user_perm[] =
        User::where('role_id', $role->id)->update($user_perm);

        $role->syncPermissions($permissions);

        Session::flash('success', 'Record has been updated successfully.');

        return redirect()->route('admin.roles.index');
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('roles_destroy')) {
            return abort(401);
        }
        $role = Role::findOrFail($id);
        $role->delete();
        Session::flash('success', 'Record has been deleted successfully.');
        return redirect()->route('admin.roles.index');
    }


    /**
     * Activate Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        if (! Gate::allows('roles_active')) {
            return abort(401);
        }

        $Role = Role::findOrFail($id);
        $Role->update(['status' => 1]);

        Session::flash('success', 'Record has been active successfully.');

        return redirect()->route('admin.roles.index');
    }

    /**
     * Inactivate Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive($id)
    {
        if (! Gate::allows('roles_inactive')) {
            return abort(401);
        }

        $Role = Role::findOrFail($id);
        $Role->update(['status' => 0]);

        Session::flash('success', 'Record has been in-active successfully.');

        return redirect()->route('admin.roles.index');
    }

}
