<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class RolePermission extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['id','role_name', 'permissions','created_by', 'updated_by', 'deleted_by'];

    protected $table = 'role_permissions';
}
