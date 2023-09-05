<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreUpdateUnittypeRequest;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\Admin\Unittype;

class UnittypeController extends Controller
{
    /**
     * Display a listing of Unittype.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        $Unittypes = Unittype::all();

        return view('admin.unittype.index', compact('Unittypes'));
    }

    /**
     * Show the form for creating new Unittype.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return view('admin.unittype.create', compact('Unittypes'));
    }

    /**
     * Store a newly created Unittype in storage.
     *
     * @param  \App\Http\Requests\StoreUnittypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUnittypeRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $data = $request->all();



        Unittype::create($data);



        return redirect()->route('admin.unittype.index');
    }


    /**
     * Show the form for editing Unittype.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }



        $unittype = Unittype::findOrFail($id);

        return view('admin.unittype.edit', compact( 'unittype'));
    }

    /**
     * Update Unittype in storage.
     *
     * @param  \App\Http\Requests\UpdateUnittypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUnittypeRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $Unittype = Unittype::findOrFail($id);
        $Unittype->update($request->all());

        flash('Unit type has been updated successfully.')->success()->important();

        return redirect()->route('admin.unittype.index');
    }


    /**
     * Remove Unittype from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $permission = Unittype::findOrFail($id);
        $permission->delete();

        return redirect()->route('admin.unittype.index');
    }

    /**
     * Activate Unittype from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        if (! Gate::allows('unittype_active')) {
            return abort(401);
        }

        $Unittype = Unittype::findOrFail($id);
        $Unittype->update(['status' => 1]);

        flash('Record has been activated successfully.')->success()->important();

        return redirect()->route('admin.unittype.index');
    }

    /**
     * Inactivate Unittype from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive($id)
    {
        if (! Gate::allows('unittype_inactive')) {
            return abort(401);
        }

        $Unittype = Unittype::findOrFail($id);
        $Unittype->update(['status' => 0]);

        flash('Record has been inactivated successfully.')->success()->important();

        return redirect()->route('admin.unittype.index');
    }

    /**
     * Delete all selected Unittype at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Unittype::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
