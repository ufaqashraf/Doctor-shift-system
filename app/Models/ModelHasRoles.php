<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelHasRoles extends Model
{
    //use SoftDeletes;

    protected $fillable = [
    ];

    protected $table = 'model_has_roles';

}
