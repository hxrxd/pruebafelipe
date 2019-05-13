<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxEnviromentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_enviroment', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('forest_cover_rate');
            $table->integer('num_plans_integral_management_solid_waste');
            $table->decimal('land_use_rate');
            $table->integer('dx')->unsigned();
            $table->foreign('dx')->references('id')->on('diagnostics');
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
        Schema::drop('dx_enviroment');
    }
}
