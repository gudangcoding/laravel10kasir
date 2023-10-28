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
<<<<<<< HEAD
             'name' => 'anas', 
=======
             'name' => 'Naufal', 
>>>>>>> b9b958eb05244e29232620635c48280855a58dc4
             'email' => 'a@a.com',
             'password' => bcrypt('1111'),
             'foto' => 'user.png',
             'level' => 1
            ],
            [
<<<<<<< HEAD
             'name' => 'bbb', 
=======
             'name' => 'Naura Kamila', 
>>>>>>> b9b958eb05244e29232620635c48280855a58dc4
             'email' => 'b@b.com',
             'password' => bcrypt('1111'),
             'foto' => 'user.png',
             'level' => 2
            ]
          ));
    }
}
