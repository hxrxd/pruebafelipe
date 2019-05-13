<?php

use Illuminate\Database\Seeder;

class DepartamentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('departament')->insert([
           ['departament'=> 'Guatemala'],
           ['departament'=> 'El Progreso'],
           ['departament'=> 'Sacatepéquez'],
           ['departament'=> 'Chimaltenango'],
           ['departament'=> 'Escuintla'],
           ['departament'=> 'Santa Rosa'],
           ['departament'=> 'Sololá'],
           ['departament'=> 'Totonicapán'],
           ['departament'=> 'Quetzaltenango'],
           ['departament'=> 'Suchitepéquez'],
           ['departament'=> 'Retalhuleu'],
           ['departament'=> 'San Marcos'],
           ['departament'=> 'Huehuetenango'],
           ['departament'=> 'El Quiché'],
           ['departament'=> 'Baja Verapaz'],
           ['departament'=> 'Alta Verapaz'],
           ['departament'=> 'El Petén '],
           ['departament'=> 'Izabal'],
           ['departament'=> 'Zacapa'],
           ['departament'=> 'Chiquimula'],
           ['departament'=> 'Jalapa'],
           ['departament'=> 'Jutiapa'],
            ]);
    }
}
