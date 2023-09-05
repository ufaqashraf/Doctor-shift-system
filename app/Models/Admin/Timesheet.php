<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;


class Timesheet extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['hospital_id','dept_id','users_id','grade_id','detail_id','job_id','time_to','time_from','break_time','rate',
        'comments','signature','date','is_time_changed','line_manager_status','line_manager_notified','sent_to_payroll',
        'date_from','date_to' ,'calculated_amount','job_amount','job_hours',
        'payment_received','status','is_disputed','created_by', 'updated_by', 'deleted_by'];



    protected $table = 'timesheet';

    public function hosp_name(){
        return $this->belongsTo('App\Models\Admin\Hospital','hospital_id');
    }
    public function dep_name(){
        return $this->belongsTo('App\Models\Admin\Departments','dept_id');
    }
    public function user_name(){
        return $this->belongsTo('App\User','users_id');
    }

    public function grade_name(){
        return $this->belongsTo('App\Models\Admin\Grade','grade_id');
    }

    public function job_name(){
        return $this->belongsTo('App\Models\Admin\Job','job_id');
    }
    public function Doc_name(){
        return $this->belongsTo('App\User','users_id');
    }

}
