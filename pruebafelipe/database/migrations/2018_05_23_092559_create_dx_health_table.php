<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxHealthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_health', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('rate_access_primary_health_care');
            $table->decimal('rate_diseases_by_contaminated_water');
            $table->decimal('rate_chronic_malnutrition');
            $table->string('diseases');
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
        Schema::drop('dx_health');
    }
}
