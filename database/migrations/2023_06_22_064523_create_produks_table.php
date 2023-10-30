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
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id_produk');          
            $table->string('kode_produk');           
            $table->integer('id_kategori');           
            $table->string('nama_produk', 100);           
            $table->string('merk', 50);             
            $table->string('satuan', 50);             
            $table->string('gambar')->nullable();             
            $table->bigInteger('harga_beli');         
            $table->integer('diskon');             
            $table->bigInteger('harga_jual');          
            $table->integer('stok');      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
