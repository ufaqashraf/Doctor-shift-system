<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialYears extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name', 'start_date', 'end_date', 'status', 'created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'financial_years';

    static public function pluckActiveOnly() {
        return self::where(['status' => 1])->OrderBy('name','asc')->pluck('name','id');
    }
}
