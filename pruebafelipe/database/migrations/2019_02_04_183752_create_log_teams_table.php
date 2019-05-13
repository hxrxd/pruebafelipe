<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->string('activity');
            $table->string('description',512);
            $table->string('user');
            $table->integer('team')->unsigned()->nullable();
            $table->foreign('team')->references('id_team')->on('teams');
            $table->integer('objective')->unsigned()->nullable();
            $table->foreign('objective')->references('id')->on('objectives')->onDelete('cascade');
            $table->integer('working_plan')->unsigned()->nullable();
            $table->foreign('working_plan')->references('id')->on('working_plan')->onDelete('cascade');
            $table->integer('project')->unsigned()->nullable();
            $table->foreign('project')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::drop('log_teams');
    }
}
