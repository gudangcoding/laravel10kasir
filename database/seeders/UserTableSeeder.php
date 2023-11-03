<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = array(
            [
                'name' => 'Annasia',
                'email' => 'a@a.com',
                'password' => bcrypt('123'),
                'foto' => 'kosong.jpg',
                'level' => 1
            ],
            [
                'name' => 'Kasir 1',
                'email' => 'b@b.com',
                'password' => bcrypt('123'),
                'foto' => 'kosong.jpg',
                'level' => 2
            ]
        );

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }, $users);
    }
}
