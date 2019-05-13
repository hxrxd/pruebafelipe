<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity',1024);
            $table->string('time')->nullable();
            $table->integer('status')->default(1);
            $table->date('startdate');
            $table->date('deadline');
            $table->integer('workplan')->unsigned()->nullable();
            $table->foreign('workplan')->references('id')->on('workplans');
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
        Schema::drop('activities');
    }
}
