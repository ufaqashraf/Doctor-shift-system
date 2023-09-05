<?php


namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class UserDevices extends Model
{
    use SoftDeletes;
    //
    protected $fillable =['user_id','device_token'];
    protected $table = 'user_devices';


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
