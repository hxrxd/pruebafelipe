<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase')->unsigned();
            $table->foreign('purchase')->references('id')->on('inv_purchases');
            $table->integer('article')->unsigned();
            $table->foreign('article')->references('id')->on('inv_articles');
            $table->string('inv_number');
            $table->date('open_date');
            $table->integer('resp_target_number');
            $table->string('observations');
            $table->integer('employee')->unsigned();
            $table->foreign('employee')->references('id')->on('employees');
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
        Schema::drop('inv_details');
    }
}
