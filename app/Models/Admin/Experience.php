<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'doctor_id', 'hospital_id', 'dept_id', 'from_date', 'to_date', 'job_title', 'id_card' 
    ];

    public function hosp_name(){
        return $this->belongsTo('App\Models\Admin\Hospital','hospital_id');
    }
    public function dep_name(){
        return $this->belongsTo('App\Models\Admin\Departments','dept_id');
    }

     public function job_name(){
        return $this->belongsTo('App\Models\Admin\Grade','job_title');
    }
    public function user_name(){
        return $this->belongsTo('App\User','doctor_id');
    }
}
