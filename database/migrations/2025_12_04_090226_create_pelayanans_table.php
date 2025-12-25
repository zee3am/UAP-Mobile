<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pelayanans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pelanggan');
        $table->string('jenis_sepatu');
        $table->string('layanan');
        $table->integer('harga');
        $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanans');
    }
};
