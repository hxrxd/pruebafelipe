<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_objectives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan')->unsigned();
            $table->foreign('plan')->references('id')->on('plan')->onDelete('cascade');
            $table->integer('objective')->unsigned();
            $table->foreign('objective')->references('id')->on('objectives')->onDelete('cascade');
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
        Schema::drop('plan_objectives');
    }
}
