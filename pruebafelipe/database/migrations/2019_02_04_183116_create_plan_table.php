<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('month',15);
            $table->integer('nmonth');
            $table->string('experiences',1600)->nullable();
            $table->boolean('validated')->default(false);
            $table->integer('status')->default(0);
            $table->string('experiences_corrections',2500)->nullable();
            $table->integer('team')->unsigned()->nullable();
            $table->foreign('team')->references('id_team')->on('teams');
            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');
            $table->string('cohort');
            $table->string('user_create');
            $table->string('user_update');
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
        Schema::drop('plan');
    }
}
