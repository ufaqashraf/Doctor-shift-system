<?php


namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Job extends Model
{
    use SoftDeletes;
    //
    protected $fillable =['hospital_id','departments_id','users_id','time_to','time_from','description','title', 'date','save_status','vacancies','num_of_grades','overall_status','status','created_by','updated_by', 'deleted_by'];
    protected $table = 'job';

    static public function pluckActiveOnly() {
        return self::where(['status' => 1])->OrderBy('name','asc')->pluck('name','id');
    }

    public function hosp_name(){
        return $this->belongsTo('App\Models\Admin\Hospital','hospital_id');
    }
    public function dep_name(){
        return $this->belongsTo('App\Models\Admin\Departments','departments_id');
    }
    public function user_name(){
        return $this->belongsTo('App\User','users_id');
    }
}
