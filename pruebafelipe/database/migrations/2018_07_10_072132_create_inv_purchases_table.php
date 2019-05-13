<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('oc_no')->nullable();
            $table->date('pdate');
            $table->decimal('value',6,2);
            $table->integer('provider')->unsigned();
            $table->foreign('provider')->references('id')->on('inv_providers');
            $table->string('user');
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
        Schema::drop('inv_purchases');
    }
}
