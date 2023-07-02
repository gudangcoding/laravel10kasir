<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert(array(
            [
             'name' => 'Naufal', 
             'email' => 'admin@gmail.com',
             'password' => bcrypt('12345678'),
             'foto' => 'user.png',
             'level' => 1
            ],
            [
             'name' => 'Naura Kamila', 
             'email' => 'nabil@gmail.com',
             'password' => bcrypt('12345678'),
             'foto' => 'user.png',
             'level' => 2
            ]
          ));
    }
}
