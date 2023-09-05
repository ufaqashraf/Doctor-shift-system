<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','first_name','sur_name','gmc','hospital_id','dept_id','hospital_user_id','role_id',
        'grade_id','doc_hospital','doc_dept','gender','address','image','active','approved','permissions',
        'urgent_jobs','approved_jobs','upcomming_shift','same_day_shift','submit_timesheet','approved_timesheet',
        'reset_token','created_by','updated_by','deleted_by','id_image','device_token'
    ];




    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function role_name()
    {
        return $this->belongsTo('App\Models\Admin\RolePermission', 'role_id');
    }

    public function hosp_name(){
        return $this->belongsTo('App\Models\Admin\Hospital','doc_hospital');
    }
    public function dep_name(){
        return $this->belongsTo('App\Models\Admin\Departments','doc_dept');
    }
    public function hosp(){
        return $this->belongsTo('App\Models\Admin\Hospital','hospital_id');
    }
    public function dep(){
        return $this->belongsTo('App\Models\Admin\Departments','dept_id');
    }

    public function admin_hosp(){
        return $this->belongsTo('App\Models\Admin\Hospital','hospital_id');
    }
    public function admin_dept(){
        return $this->belongsTo('App\Models\Admin\Departments','dept_id');
    }

}
