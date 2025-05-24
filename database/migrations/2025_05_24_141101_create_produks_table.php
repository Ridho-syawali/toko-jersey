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
    
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jersey'); // Contoh: "Jersey Liverpool Home 2023"
            $table->string('deskripsi')->nullable(); // Deskripsi produk
            $table->string('merk')->nullable(); // Nike, Adidas, dll
            $table->decimal('harga', 10, 2); // Contoh: 250000.00
            $table->integer('stok');
            $table->string('gambar')->nullable(); // Nama file gambar (simpan di `storage/app/public/jerseys`)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
