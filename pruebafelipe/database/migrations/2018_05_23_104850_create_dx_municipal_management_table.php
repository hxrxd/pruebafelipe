<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxMunicipalManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_municipal_management', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('municipal_management_index');
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
        Schema::drop('dx_municipal_management');
    }
}
