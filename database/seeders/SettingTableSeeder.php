<?php

namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert(array(
            [
             'nama_perusahaan' => 'Heymart', 
             'alamat' => 'Jl. Citarum, Slawi, Tegal',
             'telepon' => '085823423232',
             'logo' => 'logo.png',
             'kartu_member' => 'card.png',
             'diskon_member' => '10',
             'tipe_nota' => '0'
            ]
           ));
    }
}
