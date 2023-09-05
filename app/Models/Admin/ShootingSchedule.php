<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class ShootingSchedule extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['project_id','day_no','duration', 'time_start','time_end','scene', 'sc_date','camera','cast','short_desc','image','screen_notes','created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'shooting_schedule';

    public function project_name(){
        return $this->belongsTo('App\Models\Projects','project_id');
    }

}
