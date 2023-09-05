<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\PermissionHelper as Per;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;
use Session;

class PermissionsController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Per::has_permission('users_manage')) {
            return abort(401);
        }

        $Permissions = Permission::all();
        $Roles = array();

        return view('admin.permissions.index', compact('Permissions', 'Roles'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $Permissions = ['' => 'Select a Parent Group', 0 => 'This is Parent Group'];

        $PermissionsData = Permission::where('main_group', 1)->OrderBy('name', 'asc')->get();
        if($PermissionsData) {
            foreach ($PermissionsData as $permission) {
                $Permissions[$permission->id] = $permission->name;
            }
        }

        return view('admin.permissions.create', compact('Permissions'));
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionsRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $data = $request->all();
        if(!$data['parent_id']) {
            $data['main_group'] = 1;
        }

        try {
            Permission::create($data);

            flash('Permission has been added successfully.')->success()->important();
        } catch (PermissionAlreadyExists $e) {
            $request->flash();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
        Session::flash('success', 'Record has been store successfully.');
        return redirect()->route('admin.permissions.index');
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $Permissions = ['' => 'Select a Parent Group', 0 => 'This is Parent Group'];

        $PermissionsData = Permission::where('main_group', 1)->OrderBy('name', 'asc')->get();
        if($PermissionsData) {
            foreach ($PermissionsData as $permission) {
                $Permissions[$permission->id] = $permission->name;
            }
        }

        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission', 'Permissions'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        Session::flash('success', 'Record has been updated successfully.');

        return redirect()->route('admin.permissions.index');
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission = Permission::findOrFail($id);
        $permission->delete();

        Session::flash('success', 'Record has been deleted successfully.');
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Activate Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        if (! Gate::allows('permissions_active')) {
            return abort(401);
        }

        $Permission = Permission::findOrFail($id);
        $Permission->update(['status' => 1]);

        Session::flash('success', 'Record has been active successfully.');

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Inactivate Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive($id)
    {
        if (! Gate::allows('permissions_inactive')) {
            return abort(401);
        }

        $Permission = Permission::findOrFail($id);
        $Permission->update(['status' => 0]);

        Session::flash('success', 'Record has been inactive successfully.');

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Permission::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
