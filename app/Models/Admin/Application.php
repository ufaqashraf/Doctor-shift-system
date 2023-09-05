<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;


class Application extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['hospital_id','dept_id','job_id','job_detail_id','grade_id','user_id','applied_date','status','created_by', 'updated_by', 'deleted_by'];

    protected $table = 'applications';

    public function job_name(){
        return $this->belongsTo('App\Models\Admin\Job','job_id');
    }

    public function hosp_name(){
        return $this->belongsTo('App\Models\Admin\Hospital','hospital_id');
    }
    public function dep_name(){
        return $this->belongsTo('App\Models\Admin\Departments','dept_id');
    }

    public function user_name(){
        return $this->belongsTo('App\User','user_id');
    }

    public function detail_name(){
        return $this->belongsTo('App\Models\Admin\Jobdetail','job_detail_id');
    }
    public function grade_name(){
        return $this->belongsTo('App\Models\Admin\Grade','grade_id');
    }
    

}
