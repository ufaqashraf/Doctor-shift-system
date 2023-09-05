<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('days_of_shooting',255)->nullable();
            $table->string('director',100)->nullable();
            $table->string('producer',100)->nullable();
            $table->string('breakfast_time',100)->nullable();
            $table->string('lunch_time',100)->nullable();
            $table->string('est_wrap',100)->nullable();
            $table->string('location_info',100)->nullable();
            $table->string('weather_info',100)->nullable();
            $table->string('crew_info',100)->nullable();
            $table->string('map_link',500)->nullable();
            $table->string('unit_notes',100)->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Foreign Key relationships
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
        Schema::dropIfExists('projects');
    }
}
