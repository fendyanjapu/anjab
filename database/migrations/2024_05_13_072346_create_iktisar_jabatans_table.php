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
        Schema::create('iktisar_jabatans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan_sopd');
            $table->longText('iktisar')->nullable();

            $table->string('name', 100)->nullable()->default('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iktisar_jabatans');
    }
};
