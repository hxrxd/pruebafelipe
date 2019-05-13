<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->increments('id_check');
            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');
            $table->integer('receipt')->unsigned();
            $table->foreign('receipt')->references('id_receipts')->on('receipts');
            $table->integer('grant');
            $table->string('nocheck');
            $table->date('datein')->nullable();
            $table->date('datepay')->nullable();
            $table->date('dateout')->nullable();
            $table->string('desc')->nullable();;

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
        Schema::drop('checks');
    }
}
