<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $per = Permission::pluck('name');

        $data['permissions'] = implode(',',json_decode(json_encode($per) ,true));
        User::where('id',1)->update($data);
    }
}
