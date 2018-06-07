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
        DB::table('users')->Insert([
            'name'=>'Ruben',
            'tipo'=>'ADMIN',
            'email'=>'ruben_rc@yahoo.com',
            'password'=>bcrypt('secret'),
            ]);
        DB::table('users')->Insert([
            'name'=>'Alma Villaseñor Franco',
            'tipo'=>'ADMIN',
            'email'=>'alma@yahoo.com',
            'password'=>bcrypt('secret'),
            ]);
        DB::table('users')->Insert([
            'name'=>'Sulpicio Sanchez Tizapa',
            'tipo'=>'ADMIN',
            'email'=>'sulpicio@yahoo.com',
            'password'=>bcrypt('secret'),
            ]);
        DB::table('users')->Insert([
            'name'=>'Fermin Hernandez Patricio',
            'tipo'=>'USR',
            'email'=>'fermin',
            'password'=>bcrypt('secret'),
            ]);        
    }
}
