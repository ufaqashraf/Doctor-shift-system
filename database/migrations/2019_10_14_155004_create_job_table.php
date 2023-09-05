<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hospital_id');
            $table->unsignedInteger('departments_id');
            $table->unsignedInteger('users_id');
            $table->unsignedTinyInteger('hire_status')->default(1);
            $table->time('time_to')->nullable();
            $table->time('time_from')->nullable();
            $table->text('description')->nullable();
            $table->string('title')->nullable();
            $table->string('overall_status',20)->default('draft');
            $table->date('date')->nullable();
            $table->unsignedInteger('vacancies')->nullable();;
            $table->unsignedInteger('num_of_grades');
            $table->unsignedTinyInteger('status')->default(1);

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->foreign('departments_id')->references('id')->on('departments');
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
        Schema::dropIfExists('job');
    }
}
