<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Databanks extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','office_phone','industry','grade','website','fax',
        'primary_email','secondary_email','sector','region','branch','territory',
        'gst_no','ntn_no','assigned_to','pst',
        'street','city','state','postal_code','country',
        'status', 'created_by', 'updated_by', 'deleted_by',
    ];

    protected $table = 'mrk_databanks';

    public static function databanksAll(){
        $Databanks  = Databanks::selectRaw('mrk_databanks.*, hrm_employees.first_name as emp_name,  branches.name as org_name, territory.name as ter_name')
            ->leftJoin('hrm_employees','mrk_databanks.assigned_to','=','hrm_employees.user_id')
            ->leftJoin('territory','mrk_databanks.territory','=','territory.id')
            ->leftJoin('branches','mrk_databanks.branch','=','branches.id')->OrderBy('created_at','desc')
            ->get();
        return $Databanks;
    }

    public static function databanksAssigned($assigned_to){
        $Databanks  = Databanks::selectRaw('mrk_databanks.*, hrm_employees.first_name as emp_name,  branches.name as org_name, territory.name as ter_name')
            ->leftJoin('hrm_employees','mrk_databanks.assigned_to','=','hrm_employees.user_id')
            ->leftJoin('branches','mrk_databanks.branch','=','branches.id')
            ->leftJoin('territory','mrk_databanks.territory','=','territory.id')
            ->where('mrk_databanks.assigned_to', $assigned_to)
            ->OrderBy('created_at','desc')
            ->get();
        return $Databanks;
    }

    public static function databanksByBranch($branch_id , $user_ids){
        $Databanks  = Databanks::selectRaw('mrk_databanks.*, hrm_employees.first_name as emp_name,  branches.name as org_name, territory.name as ter_name')
            ->leftJoin('hrm_employees','mrk_databanks.assigned_to','=','hrm_employees.user_id')
            ->leftJoin('branches','mrk_databanks.branch','=','branches.id')
            ->leftJoin('territory','mrk_databanks.territory','=','territory.id')
            ->where('mrk_databanks.branch', $branch_id)
            ->whereIn('mrk_databanks.assigned_to', $user_ids)
            ->OrderBy('created_at','desc')
            ->get();
        return $Databanks;
    }

    public static function databanksDetailByBranch($branch_id ){
        $Databanks  = Databanks::selectRaw('mrk_databanks.*, hrm_employees.first_name as emp_name,  branches.name as org_name, territory.name as ter_name')
            ->leftJoin('hrm_employees','mrk_databanks.assigned_to','=','hrm_employees.user_id')
            ->leftJoin('branches','mrk_databanks.branch','=','branches.id')
            ->leftJoin('territory','mrk_databanks.territory','=','territory.id')
            ->where('mrk_databanks.branch', $branch_id)

            ->OrderBy('created_at','desc')
            ->get();
        return $Databanks;
    }

    public static function databanksDetailBySector($sector_id ){
        $Databanks  = Databanks::selectRaw('mrk_databanks.*, hrm_employees.first_name as emp_name,  branches.name as org_name, territory.name as ter_name')
            ->leftJoin('hrm_employees','mrk_databanks.assigned_to','=','hrm_employees.user_id')
            ->leftJoin('branches','mrk_databanks.branch','=','branches.id')
            ->leftJoin('territory','mrk_databanks.territory','=','territory.id')
            ->where('mrk_databanks.sector', $sector_id)

            ->OrderBy('created_at','desc')
            ->get();
        return $Databanks;
    }

    public static function databanksDetailByRegion($region_id ){
        $Databanks  = Databanks::selectRaw('mrk_databanks.*, hrm_employees.first_name as emp_name,  branches.name as org_name, territory.name as ter_name')
            ->leftJoin('hrm_employees','mrk_databanks.assigned_to','=','hrm_employees.user_id')
            ->leftJoin('branches','mrk_databanks.branch','=','branches.id')
            ->leftJoin('territory','mrk_databanks.territory','=','territory.id')
            ->where('mrk_databanks.region', $region_id)

            ->OrderBy('created_at','desc')
            ->get();
        return $Databanks;
    }


    public static function databanksByTerritory($territory_id, $user_ids){
        $Databanks  = Databanks::selectRaw('mrk_databanks.*, hrm_employees.first_name as emp_name,  branches.name as org_name, territory.name as ter_name')
            ->leftJoin('hrm_employees','mrk_databanks.assigned_to','=','hrm_employees.user_id')
            ->leftJoin('branches','mrk_databanks.branch','=','branches.id')
            ->leftJoin('territory','mrk_databanks.territory','=','territory.id')
            ->where('mrk_databanks.territory', $territory_id)
            ->whereIn('mrk_databanks.assigned_to', $user_ids)
            ->OrderBy('created_at','desc')
            ->get();
        return $Databanks;
    }

    public static function databanksByUsers($user_ids){
        $Databanks  = Databanks::selectRaw('mrk_databanks.*, hrm_employees.first_name as emp_name,  branches.name as org_name, territory.name as ter_name')
            ->leftJoin('hrm_employees','mrk_databanks.assigned_to','=','hrm_employees.user_id')
            ->leftJoin('branches','mrk_databanks.branch','=','branches.id')
            ->leftJoin('territory','mrk_databanks.territory','=','territory.id')
            ->whereIn('mrk_databanks.assigned_to', $user_ids)
            ->OrderBy('created_at','desc')
            ->get();
        return $Databanks;
    }

    public static function databankById($id){
        $Databank  = Databanks::selectRaw('mrk_databanks.*,mrk_contacts.id as contact_id, territory.name as ter_name,
         mrk_contacts.first_name as contact_first_name,mrk_contacts.last_name as contact_last_name,
          branches.name as org_name,hrm_employees.first_name as emp_name,
       
        mrk_contacts.office_phone as contact_office_phone,mrk_contacts.mobile_phone as contact_mobile_phone,
        mrk_contacts.title as contact_title,mrk_contacts.department as contact_department')
            ->leftJoin('hrm_employees','mrk_databanks.assigned_to','=','hrm_employees.user_id')
            ->leftJoin('mrk_contacts','mrk_databanks.id','=','mrk_contacts.databank_id')
            ->leftJoin('territory','mrk_databanks.territory','=','territory.id')
            ->leftJoin('branches','mrk_databanks.branch','=','branches.id')->where('mrk_databanks.id', $id)
            ->first();

        return $Databank;
    }

    public static function databanksByName($name,$assigned_to){
        $Databanks  = Databanks::selectRaw('mrk_databanks.id, mrk_databanks.name')

            ->where('name', 'like', '%' .$name . '%')
            ->where('mrk_databanks.assigned_to', $assigned_to)
            ->where('status', '1')
            ->get();
        return $Databanks;
    }

    public static function databanksByNameOnly($name){
        $Databanks  = Databanks::selectRaw('mrk_databanks.id, mrk_databanks.name')

            ->where('name', 'like', '%' .$name . '%')
            ->where('status', '1')
            ->get();
        return $Databanks;
    }

    public static function databanksByNameAndBranch($name, $branch_id){
        $Databanks  = Databanks::selectRaw('mrk_databanks.id, mrk_databanks.name')

            ->where('name', 'like', '%' .$name . '%')
            ->where('status', '1')
            ->where('branch', $branch_id)
            ->get();
        return $Databanks;
    }

    public static function databanksByNameAndRegion($name, $region_id){
        $Databanks  = Databanks::selectRaw('mrk_databanks.id, mrk_databanks.name')
            ->where('name', 'like', '%' .$name . '%')
            ->where('status', '1')
            ->where('region', $region_id)
            ->get();
        return $Databanks;
    }

    public function Contacts() {
        return $this->hasMany('App\Models\Marketing\Contacts', 'databank_id');
    }

    public function Assigned() {
        return $this->belongsTo('App\Models\HRM\Employees', 'assigned_to','user_id');
    }

    public function Region() {
        return $this->belongsTo('App\Models\Admin\Regions', 'region','id');
    }

    public function Branch() {
        return $this->belongsTo('App\Models\Admin\Branches', 'branch','id');
    }

    public function Territory() {
        return $this->belongsTo('App\Models\Admin\Territory', 'territory','id');
    }

    static public function pluckActiveAll() {
        return self::where(['status' => 1])->OrderBy('name','asc')->pluck('name','id');
    }

    static public function pluckAssignedBranch($branch_id, $user_ids) {
        return self::where(['status' => 1, 'branch' => $branch_id])->whereIn('assigned_to', $user_ids)->pluck('id');
    }
    static public function pluckBranchDatabanks($branch_id) {
        return self::where(['status' => 1, 'branch' => $branch_id])->pluck('name' ,'id');
    }
    static public function pluckRegionDatabanks($region_id) {
        return self::where(['status' => 1, 'region' => $region_id])->pluck('name' ,'id');
    }
    static public function pluckAssignedTerr($terr_id, $user_ids) {
        return self::where(['status' => 1 , 'territory' => $terr_id])->whereIn('assigned_to', $user_ids)->pluck('id');
    }
    static public function pluckActiveOnly($assigned_to) {
        return self::where(['status' => 1,'assigned_to' => $assigned_to])->OrderBy('name','asc')->pluck('name','id');
    }
    static public function pluckRegionDBIds($region_id) {
        return self::where(['status' => 1, 'region' => $region_id])->pluck('id');
    }
    static public function pluckBranchDBIds($branch_id) {
        return self::where(['status' => 1, 'branch' => $branch_id])->pluck('id');
    }

    static public function pluckTerritoryDBIds($territory_id) {
        return self::where(['status' => 1, 'territory' => $territory_id])->pluck('id');
    }
}
