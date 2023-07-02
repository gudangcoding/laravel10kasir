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
        Schema::create('penjualan__details', function (Blueprint $table) {
            $table->increments('id_penjualan_detail');
            $table->integer('id_penjualan')->unsigned();
            $table->bigInteger('kode_produk')->unsigned();
            $table->bigInteger('harga_jual')->unsigned();
            $table->integer('jumlah')->unsigned();
            $table->integer('diskon')->unsigned();
            $table->bigInteger('sub_total')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan__details');
    }
};
