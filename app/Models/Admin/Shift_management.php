<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Shift_management extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name','time_to','time_from','status','created_by', 'updated_by', 'deleted_by'];

    protected $table = 'shift_management';
}
