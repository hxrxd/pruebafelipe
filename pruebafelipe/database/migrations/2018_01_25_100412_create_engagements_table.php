<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engagements', function (Blueprint $table) {
            $table->increments('id_engagement');
            $table->integer('no')->unsigned();
            $table->integer('year');

            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');

            $table->integer('agreement')->unsigned();
            $table->foreign('agreement')->references('id_agreement')->on('agreement');
            
            $table->integer('contract')->unsigned();
            $table->foreign('contract')->references('id_contracts')->on('contracts');

            $table->date('initd');
            $table->date('endd');
            $table->string('length');
            $table->string('grantm');
            $table->integer('grant');
            $table->integer('payments');
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
        // Schema::drop('engagements');
    }
}
