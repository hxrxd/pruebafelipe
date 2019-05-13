<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team')->unsigned();
            $table->foreign('team')->references('id_team')->on('teams');
            $table->string('cohort');
            $table->integer('status');
            $table->string('observations',2500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('working_plan');
    }
}
