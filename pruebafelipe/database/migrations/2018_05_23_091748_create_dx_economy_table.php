<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxEconomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_economy', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->decimal('poverty');
            $table->decimal('poverty_extreme');
            $table->decimal('income_per_family');
            $table->string('observations')->nullable();
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
        Schema::drop('dx_economy');
    }
}
