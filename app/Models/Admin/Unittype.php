<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Unittype extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name','status','created_by', 'updated_by'. 'deleted_by'];


    protected $table = 'unit_type';
    static public function pluckUnitTypes() {
        return self::pluck('name', 'id');
    }

}
