<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'address','image','currency','company', 'status', 'created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'companies';

    static public function pluckActiveOnly() {
        return self::where(['status' => 1])->OrderBy('name','asc')->pluck('name','id');
    }

}
