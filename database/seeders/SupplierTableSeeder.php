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
        DB::table('supplier')->insert(array(
            [
                
                'nama' => 'anas',
                'alamat' => 'Jakarta',
                'telepon' => '123',
            ],
            [

                'nama' => 'Joko',
                'alamat' => 'Bekasi',
                'telepon' => '234',
            ]
        ));
    }
}
