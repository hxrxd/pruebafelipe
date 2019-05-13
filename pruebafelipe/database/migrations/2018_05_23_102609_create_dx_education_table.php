<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dx_education', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('percentage_math_test_approval_primary');
            $table->decimal('percentage_math_test_approval_secondary');
            $table->decimal('percentage_math_test_approval_diversified');
            $table->decimal('percentage_reading_test_approval_primary');
            $table->decimal('percentage_reading_test_approval_secondary');
            $table->decimal('percentage_reading_test_approval_diversified');
            $table->integer('dx')->unsigned();
            $table->foreign('dx')->references('id')->on('diagnostics');           
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
        Schema::drop('dx_education');
    }
}
