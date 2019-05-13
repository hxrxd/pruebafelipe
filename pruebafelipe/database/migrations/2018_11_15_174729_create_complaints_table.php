<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('complaints')) {
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id_complaints');
            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');
            $table->string('supervisor');
            $table->string('title_complaint');
            $table->string('desc');
            $table->string('tracing');
            $table->string('solution');
            $table->boolean('status');
            $table->timestamps();
        });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('complaints');
    }
}
