<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id_receipts');
            $table->integer('no')->unsigned();
            $table->integer('year');

            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');

            $table->integer('contract')->unsigned();
            $table->foreign('contract')->references('id_contracts')->on('contracts');
            
            $table->string('payments');
            $table->string('grantm');
            $table->integer('grant');
            $table->date('initd');
            $table->date('endd');
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
        Schema::drop('receipts');
    }
}
