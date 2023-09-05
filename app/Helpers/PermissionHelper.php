<?php

namespace App\Helpers;


use App\User;
use Config;
use Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelHasRoles;
use App\Models\RoleHasPermission;
use App\Models\Permissions;
use App\Models\Admin\RolePermission;
use App\Models\Admin\UserProjects;


/**
* Class to store the entire group tree
*/
class PermissionHelper
{
/**
* Initializer
*/

    public static  function getUserPermissions(){
        $permissions = Auth::user()->permissions;
        return explode(",",$permissions);

    }

     public static  function getProjectPermissions(){
        $loggedIn = Auth::user()->id;
        $userRoles = ModelHasRoles::where('model_id',$loggedIn)->pluck('role_id');

        $permissions = RoleHasPermission::where('role_id', $userRoles)->pluck('permission_id');
        $permission_names = Permissions::whereIn('id', $permissions)->where('status',1)->pluck('name');
        return json_decode(json_encode($permission_names), true);

    }

 	public static  function getuserProjects( $user_id){
 			// get user projects
 			$userProjects = UserProjects::where('user_id',$user_id)->pluck('role_id', 'project_id');
 			$userProjects = json_decode(json_encode($userProjects), true);
 			
 			return $userProjects;

    }

 	public static  function getRolePermission( $role_ids){
 			// get user projects
 		$rolePermission = RolePermission::whereIn('role_id' ,$role_ids )->get();
 			
		return $rolePermission;

    }

    public static  function has_permission( $permission_name){
        // get user projects

        $permissoins = Auth::user()->permissions;
//        dd($permissoins);
        $permissoins = explode(',', $permissoins);
        return in_array($permission_name , $permissoins);

//        $rolePermission = RolePermission::whereIn('role_id' ,$role_ids )->get();
//
//        return $rolePermission;

    }
}