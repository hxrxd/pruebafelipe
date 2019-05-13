<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /*$this->call(DepartamentTableSeeder::class);
        $this->call(MunicipalityTableSeeder::class);    
        $this->call(FinancingsTableSeeder::class);
        $this->call(UserTableSeeder::class);      
        $this->call(CivilStatusTableSeeder::class);      
        $this->call(GenderTableSeeder::class);    
        $this->call(PracticesTableSeeder::class);  
        $this->call(CohorteTableSeeder::class);*/
        $this->call(MetaDisciplineTableSeeder::class);

        Model::reguard();
    }
}
