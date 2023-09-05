<?php


namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Prefs extends Model
{
    use SoftDeletes;
    //
    protected $fillable =['hospital_id','department_id','grade_id','doctor_id','time_to','time_from','status','created_by','updated_by', 'deleted_by'];
    protected $table = 'prefs';


    public function hosp_name(){
        return $this->belongsTo('App\Models\Admin\Hospital','hospital_id');
    }

    public function dep_name(){
        return $this->belongsTo('App\Models\Admin\Departments','department_id');
    }

    public function grade_name(){
        return $this->belongsTo('App\Models\Admin\Grade','grade_id');
    }
    

    public function user_name(){
        return $this->belongsTo('App\User','doctor_id');
    }
}
