<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description',512);
            $table->date('start_date');
            $table->date('deadline')->nullable();
            $table->integer('duration');
            $table->boolean('done')->default(false);
            $table->decimal('cost',6,2)->default(0);
            $table->integer('objective')->unsigned()->nullable();
            $table->foreign('objective')->references('id')->on('objectives')->onDelete('cascade');
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
        Schema::drop('tasks');
    }
}
