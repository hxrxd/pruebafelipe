<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workplans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('objective_what',512);
            $table->string('objective_what_for',512);
            $table->integer('amount');
            $table->string('goal',1024);
            $table->string('quality')->nullable();
            $table->integer('time')->nullable();
            $table->integer('status')->default(0);
            $table->integer('result')->default(0);
            $table->integer('project')->unsigned()->nullable();
            $table->foreign('project')->references('id')->on('projects');
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
        Schema::drop('workplans');
    }
}
