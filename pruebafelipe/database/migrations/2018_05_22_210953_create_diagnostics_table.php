<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('introduction',512)->nullable();
            $table->string('objective',512)->nullable();
            $table->integer('team')->unsigned();
            $table->foreign('team')->references('id_team')->on('teams');
            $table->string('cohort');
            $table->string('file_path')->nullable();
            $table->string('user_create');
            $table->string('user_update');
            $table->integer('edit_flag')->default(0);
            $table->integer('editing')->default(0);
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
        Schema::drop('diagnostics');
    }
}
