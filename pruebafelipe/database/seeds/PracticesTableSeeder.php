<?php

use Illuminate\Database\Seeder;

class PracticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('practices')->insert([
           ['practice'=> 'Ejercicio Profesional Supervisado','practicea'=>'EPS'],
           ['practice'=> 'Práctica Profesional Supervisada','practicea'=>'PPS'],
           ['practice'=> 'Experiencia Docente Comunitaria','practicea'=>'EDC'],
           ['practice'=> 'Práctica de Bufete Popular','practicea'=>'PBP'],
          
           
            ]);
    }
}
