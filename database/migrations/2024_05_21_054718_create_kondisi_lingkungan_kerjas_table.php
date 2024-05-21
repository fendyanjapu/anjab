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
        Schema::create('kondisi_lingkungan_kerjas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan_sopd');
            $table->string('aspek', 255)->nullable();
            $table->string('faktor', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kondisi_lingkungan_kerjas');
    }
};
