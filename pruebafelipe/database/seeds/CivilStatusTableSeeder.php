<?php

use Illuminate\Database\Seeder;

class CivilStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          DB::table('genders')->insert([
           ['genders'=> 'Masculino'],
           ['genders'=> 'Femenino'],
           
            ]);
    }
}
