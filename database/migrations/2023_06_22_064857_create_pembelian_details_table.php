<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelian_details', function (Blueprint $table) {
            $table->increments('id_pembelian_detail');         
            $table->integer('id_pembelian');         
            $table->bigInteger('kode_produk');           
            $table->bigInteger('harga_beli');           
            $table->integer('jumlah');             
            $table->bigInteger('sub_total');      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_details');
    }
};
