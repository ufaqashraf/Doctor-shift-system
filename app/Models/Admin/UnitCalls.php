<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class UnitCalls extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['project_id','day_no', 'unit_type','time','created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'unit_calls';

    public function project_name(){
        return $this->belongsTo('App\Models\Projects','project_id');
    }

}
