<?php

use Illuminate\Database\Seeder;

class FinancingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('financings')->insert([
            [          'name'          => 'EPSUM',
                       'noname'        => '20000859',
                       'nameincharge'  => 'Licda. Elsa Aurelia Velásquez Samayoa',
                       'charge'        => 'Tesorera',
                       'item'          => '4.1.33.4.22.416',
                       'itemw'         => 'cuatro punto, uno punto, treinta y tres punto, cuatro punto, veintidos, punto cuatrocientos diez y seis'],
            [          'name'          => 'EPSUM/MINFIN',
                       'noname'        => '20041002',
                       'nameincharge'  => 'Mónica Saraí Pereira Sical',
                       'charge'        => 'Tesorera',
                       'item'          => '4.5.33.4.14.416',
                       'itemw'         => 'cuatro punto, cinco punto, treinta y tres punto, cuatro punto, catorce, punto cuatrocientos diez y seis',],

        	]);
    }
}
