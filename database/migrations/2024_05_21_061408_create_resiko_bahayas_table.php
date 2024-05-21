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
        Schema::create('resiko_bahayas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan_sopd');
            $table->string('nama_resiko', 255)->nullable();
            $table->string('penyebab', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resiko_bahayas');
    }
};
