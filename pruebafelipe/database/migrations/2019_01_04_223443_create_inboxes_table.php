<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('inboxes')) {
        Schema::create('inboxes', function (Blueprint $table) {
            $table->increments('id_inbox');
            $table->integer('no')->unsigned();
            $table->integer('year');
            $table->date('datein');
            $table->string('sender');
            $table->string('message');
            $table->string('subject');
            $table->string('observation');
            $table->boolean('status');
            $table->boolean('rev');
            $table->string('processing');
            $table->string('email');
            $table->foreign('email')->references('email')->on('users');



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
        Schema::drop('inboxes');
    }
}
