<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnReceiptsEngagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('receipts', function (Blueprint $table) {
           
            $table->integer('engagement')->unsigned();
            $table->foreign('engagement')->references('id_engagement')->on('engagements');
            
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('receipts', function (Blueprint $table) {
           
            $table->dropForeign(['engagement']);
            
        });
        

    }
}
