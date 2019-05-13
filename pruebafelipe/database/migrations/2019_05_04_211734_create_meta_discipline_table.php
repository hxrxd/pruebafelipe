<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaDisciplineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_discipline', function(Blueprint $table){
            $table->increments('id');
            $table->string('metacarrer',110);
            $table->string('academic',380);
            $table->string('carrer',380);
            $table->string('incharge',100);
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
        Schema::drop('meta_discipline');
    }
}
