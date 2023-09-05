<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class RecceNotes extends Model
{
    use SoftDeletes;
    use SoftDeletes;
    //
    protected $fillable = ['project_id','day_no','duration', 'location','time_start','time_end','scene', 'sc_date','camera','cast','short_desc','image','screen_notes','created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'recce_notes';

    public function project_name(){
        return $this->belongsTo('App\Models\Projects','project_id');
    }

}
