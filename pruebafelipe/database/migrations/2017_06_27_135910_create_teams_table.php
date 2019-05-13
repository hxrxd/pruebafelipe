<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id_team');
            $table->string('name');
            $table->integer('municipality')->unsigned();
            $table->foreign('municipality')->references('id_municipality')->on('municipality');
            $table->integer('financing')->unsigned();
            $table->foreign('financing')->references('id_financings')->on('financings');
            $table->integer('supervisor')->unsigned();
            $table->foreign('supervisor')->references('id_supervisors')->on('supervisors');
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
        Schema::drop('teams');
    }
}
