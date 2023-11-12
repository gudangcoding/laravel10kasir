<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('member')->insert(array(
            [
                'email'=> 'm@m.com',
                'password'=> bcrypt('123'),
                'kode_member' => 'M001',
                'nama' => 'Tes1',
                'alamat' => 'Jakarta',
                'telepon' =>'111',
            ],
            [
                'email'=> 'm2@m.com',
                'password'=> bcrypt('123'),
                'kode_member' => 'M002',
                'nama' => 'Te2',
                'alamat' => 'Bekasi',
                'telepon' => '222',
            ]
        ));
    }
}
