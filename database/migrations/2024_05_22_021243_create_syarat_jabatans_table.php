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
        Schema::create('syarat_jabatans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan_sopd');
            $table->string('keterampilan_kerja', 255)->nullable();
            $table->text('bakat_kerja')->nullable();
            $table->text('temperamen_kerja')->nullable();
            $table->text('minat_kerja')->nullable();
            $table->text('upaya_fisik')->nullable();
            $table->string('jenis_kelamin', 255)->nullable();
            $table->string('umur', 255)->nullable();
            $table->string('tinggi_badan', 255)->nullable();
            $table->string('berat_badan', 255)->nullable();
            $table->string('postur_badan', 255)->nullable();
            $table->string('penampilan', 255)->nullable();
            $table->text('fungsi_pekerjaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_jabatans');
    }
};
