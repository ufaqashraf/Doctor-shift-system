<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RoleSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(UserSeed::class);
        $this->call(HospitalSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(Shift_managementSeed::class);
        $this->call(GradeSeeder::class);
        $this->call(JobSeed::class);
        $this->call(Job_detailsSeed::class);
        $this->call(ApplicationSeeder::class);
        $this->call(TimesheetSeed::class);
        
            /*
             * Whatever happens with the world
             * Let this seeder at the last of seeders list for the admin
             *
             * */

        $this->call(AdminPermissionSeeder::class);
    }
}
