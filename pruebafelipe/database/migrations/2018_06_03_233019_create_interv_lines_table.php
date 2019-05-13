<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntervLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interv_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('policy',512);
            $table->string('area');
            $table->string('description',512);
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
        Schema::drop('interv_lines');
    }
}
