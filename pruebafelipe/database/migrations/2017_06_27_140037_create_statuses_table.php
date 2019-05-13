<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');
            $table->date('stationery');
            $table->date('contract')->nullable();
            $table->date('budget')->nullable();
            $table->date('toaim1')->nullable();
            $table->date('toaim2')->nullable();
            $table->date('conta')->nullable();
            $table->date('pay')->nullable();
            $table->string('notice');
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
        Schema::drop('statuses');
    }
}
