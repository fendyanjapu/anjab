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
        Schema::create('sopds', function (Blueprint $table) {
            $table->increments('id_sopd');
            $table->string('nama_sopd');
            $table->string('username');
            $table->string('password');
            $table->string('level', 1);
            $table->integer('jenis_sopd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sopds');
    }
};
