<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('objective',400);
            $table->string('activities',1024);
            $table->string('results',1024)->nullable();
            $table->string('results_ids',48)->nullable();
            $table->string('hits',256)->nullable();
            $table->string('failures',256)->nullable();
            $table->integer('indicator_number')->nullable();
            $table->string('indicator_descrip',512)->nullable();
            $table->string('goal')->nullable();
            $table->string('objective_corrections',1500);
            $table->boolean('isGroup')->default(false);
            $table->integer('status')->default(0);
            $table->integer('project')->unsigned()->nullable();
            $table->foreign('project')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');
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
        Schema::drop('objectives');
    }
}
