<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GroupsTree;
use App\Models\Admin\AccountTypes;
use App\Models\Admin\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSettingsRequest;
use App\Http\Requests\Admin\UpdateSettingsRequest;
use App\Models\Admin\Settings;
use Auth;
use Config;

class SettingsController extends Controller
{

    /**
     * Display a listing of Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('settings_manage')) {
            return abort(401);
        }

        // For below constants check config\constants.php
        $GroupIDs = Settings::whereIn('id', [
            Config::get('constants.accounts_cash_banks_head_setting_id'),
            Config::get('constants.accounts_cash_head_setting_id'),
            Config::get('constants.accounts_banks_head_setting_id'),
            Config::get('constants.accounts_lc_banks_head_setting_id'),
            Config::get('constants.accounts_stock_items_head_setting_id'),
            Config::get('constants.accounts_lc_tt_local_head_setting_id'),
            Config::get('constants.accounts_lc_head_setting_id'),
            Config::get('constants.accounts_tt_head_setting_id'),
            Config::get('constants.accounts_local_head_setting_id')
        ])->pluck('description');
        $Groups = Groups::whereIn('id', $GroupIDs)->where(['account_type_id' => Config::get('constants.accounts_assets') /* See constants.php */, 'status' => 1])->OrderBy('id', 'asc')->get()->getDictionary();
        $Setting = Settings::findOrFail(Config::get('constants.accounts_lc_banks_head_setting_id'));
        $Group = Groups::findOrFail($Setting->description);
        $Groups[$Group->id] = $Group;

        $Settings = Settings::OrderBy('created_at','desc')->get();

        return view('admin.settings.index', compact('Settings', 'Groups'));
    }

    /**
     * Show the form for creating new Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('settings_create')) {
            return abort(401);
        }
        return view('admin.settings.create');
    }

    /**
     * Store a newly created Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingsRequest $request)
    {
        if (! Gate::allows('settings_create')) {
            return abort(401);
        }

        Settings::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);

        flash('Record has been created successfully.')->success()->important();

        return redirect()->route('admin.settings.index');
    }


    /**
     * Show the form for editing Setting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('settings_edit')) {
            return abort(401);
        }
        $Setting = Settings::findOrFail($id);

        if($id == Config::get('constants.accounts_cash_banks_head_setting_id')) {
            $AssetStartGroup = Groups::where(['parent_id' => 0, 'account_type_id' => Config::get('constants.accounts_assets') /* See constants.php */, 'status' => 1])->OrderBy('id', 'asc')->first();
            $Groups = GroupsTree::buildOptions(GroupsTree::buildTree(Groups::OrderBy('name', 'asc')->get()->toArray(), $AssetStartGroup->id), $Setting->description);
        } else if($id == Config::get('constants.accounts_cash_head_setting_id') || $id == Config::get('constants.accounts_banks_head_setting_id')) {
            $DefaultCashBanksHead = Settings::findOrFail(Config::get('constants.accounts_cash_banks_head_setting_id'));
            $Groups = GroupsTree::buildOptions(GroupsTree::buildTree(Groups::OrderBy('name', 'asc')->get()->toArray(), $DefaultCashBanksHead->description), $Setting->description);
        } else if($id == Config::get('constants.accounts_lc_banks_head_setting_id') || $id == Config::get('constants.accounts_stock_items_head_setting_id')) {
            $Group = Groups::findOrFail($Setting->description);
            $Groups = GroupsTree::buildOptions(GroupsTree::buildTree(Groups::OrderBy('name', 'asc')->get()->toArray(), $Group->parent_id), $Setting->description);
        } else if($id == Config::get('constants.accounts_lc_tt_local_head_setting_id')) {
            $Group = Groups::findOrFail($Setting->description);
            $Groups = GroupsTree::buildOptions(GroupsTree::buildTree(Groups::OrderBy('name', 'asc')->get()->toArray(), $Group->parent_id), $Setting->description);
        } else if($id == Config::get('constants.accounts_lc_head_setting_id') || $id == Config::get('constants.accounts_tt_head_setting_id') || $id == Config::get('constants.accounts_local_head_setting_id')) {
            $DefaultLCHandleHead = Settings::findOrFail(Config::get('constants.accounts_lc_tt_local_head_setting_id'));
            $Groups = GroupsTree::buildOptions(GroupsTree::buildTree(Groups::OrderBy('name', 'asc')->get()->toArray(), $DefaultLCHandleHead->description), $Setting->description);
        } else {
            $Groups = '';
        }

        return view('admin.settings.edit', compact('Setting', 'Groups'));
    }

    /**
     * Update Setting in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateSettingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingsRequest $request, $id)
    {
        if (! Gate::allows('settings_edit')) {
            return abort(401);
        }

        $Setting = Settings::findOrFail($id);
        $Setting->update([
            'name' => $request['name'],
            'description' => $request['description'],
        ]);

        flash('Record has been updated successfully.')->success()->important();

        return redirect()->route('admin.settings.index');
    }


    /**
     * Remove Setting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('settings_destroy')) {
            return abort(401);
        }
        $Setting = Settings::findOrFail($id);
        $Setting->delete();

        flash('Record has been deleted successfully.')->success()->important();

        return redirect()->route('admin.settings.index');
    }

}
