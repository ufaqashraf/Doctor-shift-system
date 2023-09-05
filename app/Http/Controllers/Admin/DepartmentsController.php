<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentsRequest;
use App\Http\Requests\Admin\UpdateDepartmentsRequest;
use App\Helpers\PermissionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Departments;
use App\Models\Admin\Hospital;
use Auth;
use Config;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Departments = Departments::orderby('created_at')->get();
       
        // dd($Departments);
        return view('admin.departments.index', compact('Departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Departments = Departments::orderby('created_at')->get();

        return view('admin.departments.create', compact('Hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentsRequest $request)
    {

        $data= $request->all();
        $data['created_by']=Auth::user()->id;
        $data['updated_by']=Auth::user()->id;

        Departments::create($data);
        session()->flash('success', 'Record has been created successfully.');
        return redirect()->route('admin.departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function show(Departments $departments)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $Departments = Departments::findOrFail($id);

        return view('admin.departments.edit', compact('Departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentsRequest $request, $id)
    {
        $data=$request->all();
        $Departments = Departments::findOrFail($id);
        $data['updated_by'] = Auth::user()->id;
        $Departments->update($data);

        session()->flash('success', 'Record has been Updated successfully.');
        return redirect()->route('admin.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departments $departments)
    {
        $Departments = Departments::findOrFail($departments);
        $Departments->delete();
        return redirect()->route('admin.departments.index');
    }
}
