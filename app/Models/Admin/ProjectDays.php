<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class ProjectDays extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['project_id', 'day_no','day_date','main_unit','break_fast','lunch','dinner','est_wrap', 'created_by', 'updated_by'. 'deleted_by'];

    protected $table = 'project_days';

}
