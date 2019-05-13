<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id_contracts');
            $table->integer('no')->unsigned();
            $table->integer('year');

            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');

            $table->integer('agreement')->unsigned();
            $table->foreign('agreement')->references('id_agreement')->on('agreement');
            
            $table->date('initd');
            $table->date('date2');
            $table->date('date3');
            $table->date('date4');
            $table->date('date5');
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
        Schema::drop('contracts');
    }
}
