<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id_student');
            $table->string('email')->unique();
            $table->string('dpi');
            $table->string('dpiw');
            $table->string('carne');
            $table->string('name');
            $table->string('fsurname');
            $table->string('ssurname');
            $table->integer('gender')->unsigned();
            $table->foreign('gender')->references('id')->on('genders');
            $table->integer('cstatus')->unsigned();
            $table->foreign('cstatus')->references('id')->on('civil_statuses');
            $table->date('birthdate');
            $table->string('carrer');
            $table->string('academicu');
            $table->string('nationality');
            $table->string('adressr');
            $table->string('adressrw');
            $table->string('municipalityr');
            $table->string('municipalityb');
            $table->integer('practice')->unsigned();
            $table->foreign('practice')->references('id')->on('practices');
            $table->integer('financing')->unsigned();
            $table->foreign('financing')->references('id_financings')->on('financings');
            $table->date('initd');
            $table->date('endd');
            $table->integer('length');
            $table->integer('grant');
            $table->integer('payments');
            $table->string('grantm');
            $table->integer('headquarter')->unsigned();
            $table->foreign('headquarter')->references('id_headquarters')->on('headquarters');
            $table->integer('cohorte')->unsigned();
            $table->foreign('cohorte')->references('id')->on('cohortes');
            $table->string('personalp');
            $table->string('homep');
            $table->boolean('status');
            $table->boolean('rev');
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
        Schema::drop('students');
    }
}
