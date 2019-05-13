<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50);
            $table->string('description',160);
            $table->string('message',512)->nullable();
            $table->string('type',15)->nullable();
            $table->string('email_emisor');
            $table->string('email_receptor');
            $table->string('token',60)->nullable();
            $table->boolean('seen')->default(false);
            $table->string('link',160);
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
        Schema::drop('notifications');
    }
}
