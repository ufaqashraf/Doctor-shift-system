<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Projects extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name', 'days_of_shooting','director','producer','breakfast_time','lunch_time','est_wrap','location_info','weather_info','crew_info','map_link','unit_notes', 'created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'projects';

    public function user_name(){
        return $this->belongsTo('App\User','created_by');
    }

}
