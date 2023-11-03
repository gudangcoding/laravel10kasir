<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert(
            array(
                [

                    'nama_kategori' => 'MAKANAN',
                ],
                [
                    'nama_kategori' => 'MINUMAN',
                ]
            )
        );
    }
}