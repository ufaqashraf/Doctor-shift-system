<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('first_name')->nullable();
            $table->string('sur_name')->nullable();
            $table->string('gmc')->nullable();
            $table->unsignedInteger('hospital_id')->nullable();
            $table->unsignedInteger('dept_id')->nullable();
            $table->text('hospital_user_id')->nullable();
            $table->text('id_image')->nullable();
            $table->unsignedTinyInteger('role_id')->default(0);
            $table->unsignedInteger('grade_id')->nullable();
            $table->unsignedInteger('gender')->nullable();

            $table->string('mobile')->nullable();
            $table->string('doc_hospital')->nullable();
            $table->string('doc_dept')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('active')->default(0);

            $table->unsignedTinyInteger('urgent_jobs')->default(0);
            $table->unsignedTinyInteger('approved_jobs')->default(0);
            $table->unsignedTinyInteger('upcomming_shift')->default(0);
            $table->unsignedTinyInteger('same_day_shift')->default(0);
            $table->unsignedTinyInteger('submit_timesheet')->default(0);
            $table->unsignedTinyInteger('approved_timesheet')->default(0);
            $table->unsignedTinyInteger('approved')->default(0);

            $table->text('permissions')->nullable();
            $table->unsignedInteger('reset_token')->nullable();
            $table->unsignedInteger('device_token')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
