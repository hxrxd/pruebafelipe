<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectivesSuggestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectives_suggests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phase');
            $table->string('phase_name',96);
            $table->string('objective_suggest',400);
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
        Schema::drop('objectives_suggests');
    }
}
