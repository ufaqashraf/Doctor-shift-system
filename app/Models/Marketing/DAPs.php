<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DAPs extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'start_time','end_time','assigned_to','description',
        'status', 'created_by', 'updated_by', 'deleted_by',
    ];

    protected $table = 'mrk_daps';

    public static function dapsAll($assigned_to){

        $DAPs  = DAPs::selectRaw('mrk_daps.*, concat(hrm_employees.first_name) as emp_name')
            ->leftJoin('hrm_employees','mrk_daps.assigned_to','=','hrm_employees.user_id')
            ->where('mrk_daps.assigned_to', $assigned_to)
            ->OrderBy('start_time','asc')

            ->get();
        return $DAPs;
    }
    public static function dapById($id){
        $DAP  = DAPs::selectRaw('mrk_daps.*,
          hrm_employees.first_name as emp_name')
            ->join('hrm_employees','mrk_daps.assigned_to','=','hrm_employees.user_id')
            ->where('mrk_daps.id', $id)
            ->first();

        return $DAP;
    }

    public function Contacts() {
        return $this->hasMany('App\Models\Marketing\Contacts', 'dap_id');
    }

    static public function pluckActiveOnly() {
        return self::where(['status' => 1])->OrderBy('start_time','asc')->pluck('start_time','id');
    }
    static public function pluckDuplicate($date , $assigned_to) {
        $DAP  = DAPs::selectRaw('mrk_daps.id')
            ->where(['mrk_daps.start_time'=> $date,'mrk_daps.assigned_to'=>$assigned_to, 'mrk_daps.status' => 1])
            ->first();

        return $DAP;
    }
}
