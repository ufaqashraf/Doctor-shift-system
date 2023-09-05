<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Branches extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name','region_id', 'created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'branches';

    public static function allBranches(){
        $Branches  = Branches::selectRaw('id,name,region_id')
        ->where(['status' => 1])
        ->get();
        return $Branches;
    }

    public static function BranchesByRegion($id){
        $Branches  = Branches::selectRaw('id,name,region_id')
            ->where(['status' => 1])
            ->where(['region_id' => $id])
            ->get();
        return $Branches;
    }

    public static function allActiveBranches(){
        $Branches  = Branches::selectRaw('id,name,region_id')
            ->where(['status' => 1])

            ->get();
        return $Branches;
    }

    static public function pluckActiveOnly() {
        return self::where(['status' => 1])->OrderBy('name','asc')->pluck('name','id','region_id');
    }

    static public function pluckRegionBranches($region_id) {
        return self::where(['status' => 1, 'region_id' => $region_id])->OrderBy('name','asc')->pluck('name','id');
    }
    static public function pluckAllBranches() {
        return self::where(['status' => 1])->OrderBy('name','asc')->pluck('name','id');
    }
    static public function pluckRegionBranchesIds($region_id) {
        return self::where(['status' => 1, 'region_id' => $region_id])->OrderBy('name','asc')->pluck('id');
    }
}
