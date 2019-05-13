<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description',512);
            $table->integer('provider')->unsigned();
            $table->foreign('provider')->references('id')->on('inv_providers');
            $table->integer('status')->default(1);
            $table->integer('stock')->default(0);
            $table->decimal('cost',6,2);
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
        Schema::drop('inv_articles');
    }
}
