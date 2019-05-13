<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrixPlanningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrix_planning', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('index');
            $table->string('level',25);
            $table->string('narrative_summary',1024);
            $table->string('indicators',512);
            $table->string('means_of_verification',512);
            $table->string('assumptions',512);
            $table->string('source_info',512)->nullable();
            $table->string('collection_method',512)->nullable();
            $table->string('analysis_method',512)->nullable();
            $table->string('collection_frequency',512)->nullable();
            $table->string('responsible',512)->nullable();
            $table->integer('status')->default(0);
            $table->integer('working_plan')->unsigned()->nullable();
            $table->foreign('working_plan')->references('id')->on('working_plan')->onDelete('cascade');
            $table->string('user_create');
            $table->string('user_update');
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
        Schema::drop('matrix_planning');
    }
}
