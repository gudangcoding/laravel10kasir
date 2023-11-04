<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuatMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id_member');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('c_password')->nullable();
            $table->string('kode_member')->unique()->nullable();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
