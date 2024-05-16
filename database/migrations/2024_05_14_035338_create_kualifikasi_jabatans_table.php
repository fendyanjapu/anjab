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
        Schema::create('kualifikasi_jabatans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan_sopd');
            $table->string('pendidikan_formal', 255)->nullable();
            $table->string('pendidikan_pelatihan', 255)->nullable();
            $table->string('pengalaman_kerja', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kualifikasi_jabatans');
    }
};
