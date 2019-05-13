<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('appraisals')) {
        Schema::create('appraisals', function (Blueprint $table) {
            $table->increments('id_appraisals');
            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');
            $table->integer('age');
            $table->string('supervisor');
            $table->string('journey');
            $table->string('civil_status');
            $table->string('economic_activity');
            $table->integer('comunication');
            $table->integer('desc_comunication');
            $table->integer('type_comunication');
            $table->integer('lapse_comunication');
            $table->integer('understandable_comunication');
            $table->integer('respect_communication');
            $table->integer('fulfillment');
            $table->integer('assess_comunication');
            $table->integer('accompaniment');
            $table->integer('interest');
            $table->integer('assess_advisory');
            $table->integer('type_advisory');
            $table->integer('resolution');
            $table->integer('assess_accompaniment');
            $table->integer('assess_mono');
            $table->integer('assess_convivencia');
            $table->integer('assess_multi');
            $table->integer('assess_wp');
            $table->integer('assess_dx');
            $table->integer('respect');
            $table->integer('understandable');
            $table->integer('cooperation');
            $table->integer('amiability');
            $table->integer('assess_supervisor');
            $table->integer('complaint');
            $table->string('desc_appraisals');
            $table->string('name_student');
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
        Schema::drop('appraisals');
    }
}
