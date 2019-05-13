<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadquartersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headquarters', function (Blueprint $table) {
            $table->increments('id_headquarters');
            $table->string('name');
            $table->string('nameincharge');
            $table->string('charge');
            $table->string('phone');
            $table->integer('team')->unsigned();
            $table->foreign('team')->references('id_team')->on('teams');
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
        Schema::drop('headquarters');
    }
}
