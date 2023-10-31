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
        DB::table('suppliers')->insert(array(
            [

                'kode_member' => 'M001',
                'nama' => 'Tes1',
                'alamat' => 'Jakarta',
                'telpon' => bcrypt('1111'),
            ],
            [
                'kode_member' => 'M002',
                'nama' => 'Te2',
                'alamat' => 'Bekasi',
                'telpon' => bcrypt('2222'),
            ]
        ));
    }
}
