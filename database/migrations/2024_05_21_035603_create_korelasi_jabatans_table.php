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
        Schema::create('korelasi_jabatans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan_sopd');
            $table->string('nm_jabatan', 255)->nullable();
            $table->string('unit_kerja_instansi', 255)->nullable();
            $table->string('dalam_hal', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('korelasi_jabatans');
    }
};
