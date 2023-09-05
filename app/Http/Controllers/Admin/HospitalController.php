<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHospitalRequest;
use App\Http\Requests\Admin\UpdateHospitalRequest;
use App\Helpers\PermissionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Hospital;
use Auth;
use Config;

class HospitalController extends Controller
{

    /**
     * Display a listing of Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Hospitals = Hospital::OrderBy('created_at','desc')->get();
    

        return view('admin.hospital.index', compact('Hospitals'));
    }

    /**
     * Show the form for creating new Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Hospitals = Hospital::OrderBy('created_at','desc')->get();

        return view('admin.hospital.create', compact('Hospitals'));
    }

    /**
     * Store a newly created Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHospitalRequest $request)
    {
       $data= $request->all();
        $data['created_by']=Auth::user()->id;
        $data['updated_by']=Auth::user()->id;

        Hospital::create($data);
       
        session()->flash('success', 'Record has been created successfully.');
        return redirect()->route('admin.hospital.index');
    }


    /**
     * Show the form for editing Setting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Hospitals = Hospital::findOrFail($id);
        
        return view('admin.hospital.edit', compact('Hospitals'));
    }

    /**
     * Update Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateSettingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHospitalRequest $request, $id)
    {
        $Hospitals = Hospital::findOrFail($id);
            
        $data = $request->all();

        $data['updated_at'] = Auth::user()->id;

        $Hospitals->update($data);
        session()->flash('success', 'Record has been updated successfully.');

        return redirect()->route('admin.hospital.index');
    }


    /**
     * Remove Setting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Hospitals = Hospital::findOrFail($id);
        
        
                $Hospitals->delete();

        return redirect()->route('admin.hospital.index');
    }

}
