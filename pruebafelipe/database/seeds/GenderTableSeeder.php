<?php

use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('civil_statuses')->insert([
           ['status'=> 'Soltero'],
           ['status'=> 'Soltera'],
           ['status'=> 'Casado'],
           ['status'=> 'Casada'],
           
            ]);
    }
}
