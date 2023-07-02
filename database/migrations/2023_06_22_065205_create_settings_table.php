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
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id_setting');
            $table->string('nama_perusahaan', 100);
            $table->text('alamat');
            $table->string('telepon', 20);
            $table->string('logo', 50);
            $table->string('kartu_member', 50);
            $table->integer('diskon_member')->unsigned();
            $table->integer('tipe_nota')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
