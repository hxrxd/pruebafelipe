<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalInformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_inform', function (Blueprint $table) {
            $table->increments('id');
            $table->string('methodology',1024);
            $table->integer('direct_users',1024)->nullable();
            $table->integer('indirect_users',1024)->nullable();
            $table->integer('project')->unsigned()->nullable();
            $table->foreign('project')->references('id')->on('projects');
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
        Schema::drop('final_inform');
    }
}
