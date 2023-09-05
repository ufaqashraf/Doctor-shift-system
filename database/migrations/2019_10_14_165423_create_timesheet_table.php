<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hospital_id');
            $table->unsignedInteger('dept_id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('grade_id');
            $table->unsignedInteger('detail_id')->nullable();

            $table->unsignedInteger('job_id');
            $table->time('time_to')->nullable();
            $table->time('time_from')->nullable();
            $table->unsignedTinyInteger('break_time')->nullable();
            $table->string('rate')->nullable();
            $table->string('comments')->nullable();
            $table->string('signature')->nullable();
            $table->date('date')->nullable();


            $table->double('calculated_amount', 8, 2);
            $table->double('job_amount', 8, 2);
            $table->double('job_hours', 8, 2);
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();


            $table->unsignedTinyInteger('is_time_changed')->nullable();
            $table->unsignedTinyInteger('line_manager_status')->nullable();
            $table->unsignedTinyInteger('line_manager_notified')->nullable();
            $table->unsignedTinyInteger('sent_to_payroll')->nullable();
            $table->unsignedTinyInteger('payment_received')->nullable();
            $table->unsignedTinyInteger('is_disputed')->nullable();

            $table->unsignedTinyInteger('status')->default(1);
            
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->foreign('grade_id')->references('id')->on('grades');
            $table->foreign('job_id')->references('id')->on('job');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timesheet');
    }
}
