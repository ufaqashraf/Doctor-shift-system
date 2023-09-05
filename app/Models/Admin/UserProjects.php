<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class UserProjects extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['project_id', 'user_id','role_id','created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'user_projects';

    public function project_name(){
        return $this->belongsTo('App\Models\Admin\Projects','project_id');
    }

    public function user_name(){
        return $this->belongsTo('App\User','user_id');
    }
    public function role()
    {
        return $this->belongsTo('Spatie\Permission\Models\Role', 'role_id');
    }


}
