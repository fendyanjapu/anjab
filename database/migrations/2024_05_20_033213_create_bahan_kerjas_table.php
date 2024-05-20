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
        Schema::create('bahan_kerjas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bahan_kerja', 255)->nullable();
            $table->string('penggunaan_dalam_tugas', 255)->nullable();
            $table->integer('id_jabatan_sopd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_kerjas');
    }
};
