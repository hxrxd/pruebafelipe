<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipalityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipality', function (Blueprint $table) {
            $table->increments('id_municipality');
            $table->string('municipality');
            $table->integer('id_departament')->unsigned();
            $table->foreign('id_departament')->references('id_departament')->on('departament');
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
        Schema::drop('municipality');
    }
}
