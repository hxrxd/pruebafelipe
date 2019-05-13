<?php

use Illuminate\Database\Seeder;

class CohorteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cohortes')->insert([
           ['cohorte'=> '1c2017'],
           ['cohorte'=> '2c2017'],
           
            ]);
    }
}
