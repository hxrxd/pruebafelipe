<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequerimentAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requeriments_assignment', function(Blueprint $table){
            $table->increments('id');
            $table->integer('headquarter')->unsigned();
            $table->foreign('headquarter')->references('id_headquarters')->on('headquarters');
            $table->string('meta_discipline', 100);
            $table->string('academic_unit', 750);
            $table->string('cohorte');
            $table->integer('id_supervisors')->unsigned();
            $table->foreign('id_supervisors')->references('id_supervisors')->on('supervisors');
            $table->integer('value');
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
        Schema::drop('requeriments_assignment');
    }
}
