<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('users')->insert([
            'fname' =>'Kevin Hared',
            'lname' =>'González Cardona',
            'email' => 'kevhar10@gmail.com',
            'rol'	=> 'Admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
