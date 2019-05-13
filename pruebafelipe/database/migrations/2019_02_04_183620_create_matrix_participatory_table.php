<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrixParticipatoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrix_participatory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('direct_users');
            $table->integer('indirect_ctusers');
            $table->integer('excluded_neutral');
            $table->integer('harmed');
            $table->string('direct_descript',256);
            $table->string('indirect_descript',256);
            $table->string('excluded_descript',256);
            $table->string('harmed_descript',256);
            $table->integer('status')->default(0);
            $table->integer('working_plan')->unsigned()->nullable();
            $table->foreign('working_plan')->references('id')->on('working_plan')->onDelete('cascade');
            $table->string('user_create');
            $table->string('user_update');
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
        Schema::drop('matrix_participatory');
    }
}
