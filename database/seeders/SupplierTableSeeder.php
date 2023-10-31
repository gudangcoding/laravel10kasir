<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert(array(
            [

                'nama' => 'anas',
                'alamat' => 'Jakarta',
                'telpon' => bcrypt('1111'),
            ],
            [

                'nama' => 'Joko',
                'alamat' => 'Bekasi',
                'telpon' => bcrypt('2222'),
            ]
        ));
    }
}
