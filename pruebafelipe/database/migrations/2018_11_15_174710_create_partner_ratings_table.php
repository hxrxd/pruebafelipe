<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('partner_ratings')) {
        Schema::create('partner_ratings', function (Blueprint $table) {
            $table->increments('id_partner_ratings');
            $table->integer('student')->unsigned();
            $table->foreign('student')->references('id_student')->on('students');
            $table->integer('headquarter')->unsigned();
            $table->foreign('headquarter')->references('id_headquarters')->on('headquarters');
            $table->double('space');
            $table->double('desc_space');
            $table->double('equipment');
            $table->double('desc_equipment');
            $table->double('location');
            $table->double('community');
            $table->double('team_time');
            $table->double('capabilities');
            $table->double('asses_capabilities');
            $table->double('relationship');
            $table->double('knowledge');
            $table->double('transport');
            $table->double('stipend');
            $table->double('materials');
            $table->double('trainings');
            $table->double('permission');
            $table->double('social_risk');
            $table->double('ambiental_risk');
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
        Schema::drop('partner_ratings');
    }
}
