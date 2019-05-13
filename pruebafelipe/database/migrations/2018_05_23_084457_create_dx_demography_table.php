<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxDemographyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_demography', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->integer('population_0_to_14')->nullable();
            $table->integer('population_15_to_64')->nullable();
            $table->integer('population_65_or_more')->nullable();
            $table->integer('population_women');
            $table->integer('population_men');
            $table->integer('population_rural');
            $table->integer('population_urban');
            $table->integer('population_indigenous')->default(0);
            $table->integer('population_garifuna')->default(0);
            $table->integer('population_xinca')->default(0);
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
        Schema::drop('dx_demography');
    }
}
