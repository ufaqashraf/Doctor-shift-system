<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class UnitsModel extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name', 'shortcode', 'created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'units';

}
