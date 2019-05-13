<?php

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
            $table->string('name',512);
            $table->string('location',512);
            $table->string('description',1024);
            $table->string('justification',1024);
            $table->string('objective',512);
            $table->string('type');
            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');
            $table->integer('team')->unsigned()->nullable();
            $table->foreign('team')->references('id_team')->on('teams');
            $table->string('cohort');
            $table->integer('line')->unsigned()->nullable();
            $table->foreign('line')->references('id')->on('interv_lines');
            $table->string('stakeholders',1024);
            $table->date('startdate');
            $table->date('deadline');
            $table->string('file_path')->nullable();
            $table->integer('edit_flag')->default(0);
            $table->integer('status')->default(1);
            $table->double('budget');
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
        Schema::drop('projects');
    }
}
