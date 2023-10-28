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

             'name' => 'anas', 

             'email' => 'a@a.com',
             'password' => bcrypt('1111'),
             'foto' => 'user.png',
             'level' => 1
            ],
            [

             'name' => 'bbb', 
             'email' => 'b@b.com',
             'password' => bcrypt('1111'),
             'foto' => 'user.png',
             'level' => 2
            ]
          ));
    }
}
