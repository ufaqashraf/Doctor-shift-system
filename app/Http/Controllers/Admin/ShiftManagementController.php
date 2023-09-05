<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Helpers\PermissionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Shift_management;
use App\Helpers\PermissionHelper as Per;
use Auth;
use Config;

class ShiftManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        if (! Per::has_permission('shift_management_manage')) {
            return abort(401);
        }
        $Shifts = Shift_management::Orderby('created_at','desc')->get();
        return view('admin.shift_management.index', compact('Shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Per::has_permission('shift_management_create')) {
            return abort(401);
        }
        $Shifts = Shift_management::where('status',1)->get();
        return view('admin.shift_management.create', compact('Shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShiftRequest $request)
    {
        if (! Per::has_permission('shift_management_create')) {
            return abort(401);
        }
        $data= $request->all();
        $data['created_by']=Auth::user()->id;
         Shift_management::create($data);
       
        session()->flash('success', 'Record has been created successfully.');
        return redirect()->route('admin.shift_management.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shift_management  $shift_management
     * @return \Illuminate\Http\Response
     */
    public function show(Shift_management $shift_management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shift_management  $shift_management
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Per::has_permission('shift_management_edit')) {
            return abort(401);
        }
        $Shifts = Shift_management::findOrFail($id);
     

        return view('admin.shift_management.edit', compact('Shifts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shift_management  $shift_management
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShiftRequest $request,$id)
    {
        if (! Per::has_permission('shift_management_edit')) {
            return abort(401);
        }
        $Shifts = Shift_management::findOrFail($id);
            
        $data = $request->all();

        $data['updated_at'] = Auth::user()->id;

        $Shifts->update($data);
        session()->flash('success', 'Record has been updated successfully.');

        return redirect()->route('admin.shift_management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shift_management  $shift_management
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Per::has_permission('shift_management_destroy')) {
            return abort(401);
        }
        $Shifts = Shift_management::findOrFail($id);
        $Shifts->delete();

        return redirect()->route('admin.shift_management.index');
    }
}
