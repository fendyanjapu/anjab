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
        Schema::create('jabatan_sopds', function (Blueprint $table) {
            $table->id();
            $table->integer('id_jabatan')->unsigned();
            $table->integer('id_sopd')->unsigned();
            $table->integer('atasan')->unsigned();
            $table->timestamps();

            $table->foreign('id_sopd')->references('id_sopd')->on('sopds')->onDelete('cascade');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_sopds');
    }
};
