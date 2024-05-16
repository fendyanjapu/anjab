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
        Schema::create('tugas_pokoks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan_sopd');
            $table->longText('uraian_tugas')->nullable();
            $table->string('hasil_kerja', 255)->nullable();
            $table->string('jumlah_hasil', 255)->nullable();
            $table->string('waktu_penyelesaian_jam', 255)->nullable();
            $table->string('waktu_efektif', 255)->nullable();
            $table->string('kebutuhan_pegawai', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas__pokoks');
    }
};
