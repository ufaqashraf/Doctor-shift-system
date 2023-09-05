<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class CastCalls extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['sr_no','project_id','day_no', 'name','artist_name','call_time', 'call_to','s_by','screen_notes','created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'cast_calls';

    public function project_name(){
        return $this->belongsTo('App\Models\Projects','project_id');
    }

}
