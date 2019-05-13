<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorHsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_hs', function (Blueprint $table) {
            $table->increments('id_supervisors_h');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('place');
            
            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');
            
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
        Schema::drop('supervisor_hs');
    }
}
