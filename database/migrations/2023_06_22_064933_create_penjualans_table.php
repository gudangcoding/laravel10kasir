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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->increments('id_penjualan');        
            $table->bigInteger('kode_member')->unsigned();            
            $table->integer('total_item')->unsigned();         
            $table->bigInteger('total_harga')->unsigned();           
            $table->integer('diskon')->unsigned();       
            $table->bigInteger('bayar')->unsigned();     
            $table->bigInteger('diterima')->unsigned();     
            $table->integer('id_user')->unsigned();     
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
