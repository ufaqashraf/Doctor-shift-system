<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DapsLineitems extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'start_time','end_time','assigned_to','description','databank_id',
        'status', 'created_by', 'updated_by', 'deleted_by',
    ];

    protected $table = 'mrk_daps_lineitems';

    public static function lineItemsByDaps($id){
        $lineItems  = DapsLineitems::selectRaw('mrk_daps_lineitems.*,  mrk_databanks.name as databank_name')
            ->join('mrk_databanks','mrk_daps_lineitems.databank_id','=','mrk_databanks.id')
            ->where('mrk_daps_lineitems.dap_id', $id)

            ->get();
        return $lineItems;
    }

    public static function countLineItemsByDaps($id){
        $lineItems  = DapsLineitems::selectRaw('databank_id as databank_count')
            ->distinct('databank_id')
            ->where('mrk_daps_lineitems.dap_id', $id)

            ->count('databank_id');
        return $lineItems;
    }
}
