<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorrelativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correlatives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->string('to');
            $table->string('description');
            $table->string('email');
            $table->foreign('email')->references('email')->on('users');
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
        Schema::drop('correlatives');
    }
}
