<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Alerts extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['project_id', 'alert_type','message','status','created_by', 'updated_by'. 'deleted_by'];


    protected $table = 'alerts';

    public function project_name(){
        return $this->belongsTo('App\Models\Projects','project_id');
    }

}
