<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name', 'father_name', 'device_id','email','date_of_birth','cnic','gender',
        'department_id','job_title','job_category','date_of_joining','probation_period','contract_start_date','contract_end_date','notice_period','date_of_resign','report_to','country_id',
        'region_id','branch_id','territory_id','basic_salary','account_number','bank_name','is_sc','sc_amount',
        'is_house_rent','is_utility','is_overtime',
        'edu_level', 'edu_institute', 'edu_specialization', 'edu_year', 'edu_score', 'edu_start_date', 'edu_end_date',
        'termination_reason', 'date_of_resign',
        'marital_status','mobile','emergency_mobile','city','address',
        'status','user_id', 'created_by', 'updated_by'. 'deleted_by'
    ];

    protected $table = 'hrm_employees';

    public function job_title(){
        return $this->belongsTo('App\Models\HRM\JobTitle','job_title');
    }    

    public function employee_overtimes(){
        return $this->hasMany('App\Models\HRM\EmployeesOvertime','user_id');
    }

    public function employee_documents(){
        return $this->hasMany('App\Models\HRM\EmployeeDocuments','user_id');
    }

    static public  function allSalesman(){
        $Employees  = Employees::selectRaw('id,user_id,first_name,department_id,job_title,country_id,region_id,branch_id,territory_id,report_to')
            ->where(['status' => 1])
            //->where(['department_id' => 4])
            ->get();
        return $Employees;
    }

    static public  function employeeDetailByUserId($user_id){
        $Employees  = Employees::selectRaw('id,user_id,first_name,department_id,job_title,country_id,region_id,branch_id,territory_id,report_to')
            ->where(['status' => 1])
            ->where(['user_id' => $user_id])
            ->first();
        return $Employees;
    }

    static public  function employeeFullDetailByUserId($user_id){
        $Employees  = Employees::selectRaw('*')
            ->where(['status' => 1])
            ->where(['user_id' => $user_id])
            ->first();
        return $Employees;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getFullNameWithIdAttribute()
    {
        return $this->user_id . ' - ' . $this->first_name . " " . $this->last_name;
    }

    static public function pluckemployeeVoucherOnly() {
        return self::where(['status' => 1])->OrderBy('first_name','asc')->get()->pluck('full_name','id');
    }

    static public function getBranchByUserId($user_id){
        return self::where(['status' => 1])->where(['deleted_at' => NULL])->where(['user_id' => $user_id])->pluck('branch_id')->first();
    }

    static public function pluckActiveOnly() {
        return self::where(['status' => 1])->OrderBy('first_name','asc')->get()->pluck('full_name','user_id');
    }
    static public function pluckEngrsOnly() {
        return self::where(['status' => 1, 'department_id' => 3])->OrderBy('first_name','asc')->get()->pluck('full_name','user_id');
    }
    static public function pluckBranchEngrs($branch_id) {
        return self::where(['status' => 1, 'department_id' => 3,'branch_id'=> $branch_id])->OrderBy('first_name','asc')->get()->pluck('full_name','user_id');
    }
    static public function pluckChildsNamesByIds($user_ids) {
        return self::where(['status' => 1])->whereIn('user_id', $user_ids)->pluck('first_name','user_id');
    }

    static public function pluckActiveWithID() {
        return self::where(['status' => 1])->OrderBy('first_name','asc')->get()->pluck('full_name_with_id','user_id');
    }

    static public function pluckActiveIDsOnly() {
        return self::where(['status' => 1])->pluck('user_id');
    }

    static public function pluckActiveChildsOnly($user_ids) {
        return self::where(['status' => 1])->whereIn('report_to', $user_ids)->pluck('user_id');
    }
    static public function pluckActiveMrkOnly() {
        return self::where(['status' => 1 , 'department_id' => 4])->pluck('user_id');
    }
    static public function pluckActiveChildsMrkOnly($user_ids) {
        return self::where(['status' => 1 , 'department_id' => 4])->whereIn('report_to', $user_ids)->pluck('user_id');
    }
    static public function pluckActiveChildsTerritory($user_ids , $terr_id) {
        return self::where(['status' => 1])->whereIn('report_to', $user_ids)->pluck('user_id');
    }
    static public function pluckActiveChildsBranch($user_ids, $branch_id) {
        return self::where(['status' => 1])->whereIn('report_to', $user_ids)->pluck('user_id');
    }
    static public function getTotalEmployees() {
        return self::where(['status' => 1])->count();
    }
    static public function getJobTitleByUserId($user_id){
        return self::where('user_id',$user_id)->get()[0]->job_title()->first()->name;
    }
    static public function getEmployeeNameByUserId($user_id){
        return self::where(['user_id' => $user_id])->get()[0]->first_name;
    }

    static public function getEmployeeByUserId($user_id){
        return self::where(['user_id' => $user_id])->where(['status' => '1'])->get()->first();
    }

    static public function getOvertimeEmployeesOnly(){
        return self::where(['status' => 1])->where(['is_overtime' => 1])->OrderBy('first_name','asc')->get()->pluck('full_name','user_id');
    }

}
