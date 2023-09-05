<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGradeRequest;
use App\Http\Requests\Admin\UpdateGradeRequest;
use App\Helpers\PermissionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Grade;
use Auth;
use Config;

class GradeController extends Controller
{

    /**
     * Display a listing of Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades = Grade::OrderBy('created_at','desc')->get();

        return view('admin.grades.index', compact('Grades'));
    }

    /**
     * Show the form for creating new Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Grades = Grade::OrderBy('created_at','desc')->get();

        return view('admin.grades.create', compact('Grades'));
    }

    /**
     * Store a newly created Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data= $request->all();
        $data['created_by']=Auth::user()->id;
        $data['updated_by']=Auth::user()->id;

        Grade::create($data);
       
        session()->flash('success', 'Record has been created successfully.');
        return redirect()->route('admin.grades.index');
    }


    /**
     * Show the form for editing Setting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Grades = Grade::findOrFail($id);
        
        return view('admin.grades.edit', compact('Grades'));
    }

    /**
     * Update Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateSettingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Grades = Grade::findOrFail($id);
            
        $data = $request->all();

        $data['updated_at'] = Auth::user()->id;

        $Grades->update($data);
        session()->flash('success', 'Record has been updated successfully.');

        return redirect()->route('admin.grades.index');
    }


    /**
     * Remove Setting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Grades = Grade::findOrFail($id);
        //        $employee_exp = employee_experience::findOrFail($id);
        
                $Grades->delete();

        return redirect()->route('admin.grade.index');
    }

}
