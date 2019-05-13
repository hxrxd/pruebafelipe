<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financings', function (Blueprint $table) {
            $table->increments('id_financings');
            $table->string('name');
            $table->string('noname');
            $table->string('nameincharge');
            $table->string('charge');
            $table->string('item');
            $table->string('itemw');
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
        Schema::drop('financings');
    }
}
