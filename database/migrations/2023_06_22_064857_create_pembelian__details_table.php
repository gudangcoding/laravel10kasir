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
        Schema::create('pembelian__details', function (Blueprint $table) {
            $table->increments('id_pembelian_detail');         
            $table->integer('id_pembelian')->unsigned();         
            $table->bigInteger('kode_produk')->unsigned();           
            $table->bigInteger('harga_beli')->unsigned();           
            $table->integer('jumlah')->unsigned();             
            $table->bigInteger('sub_total')->unsigned();      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian__details');
    }
};
