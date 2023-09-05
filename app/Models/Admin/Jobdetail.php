<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;


class Jobdetail extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['job_id','grade_id','rate','vacancies','time_from','time_to','status','created_by', 'updated_by', 'deleted_by'];

    protected $table = 'job_details';

    public function grade_name(){
        return $this->belongsTo('App\Models\Admin\Grade','grade_id');
    }

}
