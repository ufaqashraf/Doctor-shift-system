<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Departments extends Model
{
    use SoftDeletes;
    //
    protected $fillable =['hospital_id','name','email','phone','address','status','created_by', 'updated_by', 'deleted_by'];
    protected $table = 'departments';

    static public function pluckActiveOnly() {
        return self::where(['status' => 1])->OrderBy('name','asc')->pluck('name','id');
    }
//    public function hosp_name(){
//        return $this->belongsTo('App\Models\Admin\Hospital','hospital_id');
//    }
}
