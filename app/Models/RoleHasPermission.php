<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleHasPermission extends Model
{
    //use SoftDeletes;

    protected $fillable = [
    ];

    protected $table = 'role_has_permissions';

}
