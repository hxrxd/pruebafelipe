<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectivesResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectives_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->string('description',255);
            $table->boolean('cuantitative')->default(false);
            $table->integer('result')->unsigned();
            $table->foreign('result')->references('id')->on('results')->onDelete('cascade');
            $table->integer('objective')->unsigned();
            $table->foreign('objective')->references('id')->on('objectives')->onDelete('cascade');
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
        Schema::drop('objectives_results');
    }
}
