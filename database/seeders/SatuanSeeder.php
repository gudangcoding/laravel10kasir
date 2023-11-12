<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satuan')->insert(
            array(
                [

                    'nama_satuan' => 'MAKANAN',
                ],
                [

                    'nama_satuan' => 'PACK',
                ],
                [

                    'nama_satuan' => 'PCS',
                ],
                [

                    'nama_satuan' => 'LITER',
                ],
                [

                    'nama_satuan' => 'BUNGKUS',
                ],
                [

                    'nama_satuan' => 'KG',
                ],
                [
                    'nama_satuan' => 'MINUMAN',
                ]
            )
        );
    }
}
