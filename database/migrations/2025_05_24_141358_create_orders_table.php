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
       // Tabel orders (header pesanan)
 Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->string('kode_order')->unique(); // Contoh: "JRS-202401-001"
    $table->decimal('total_harga', 10, 2);
    $table->enum('status', ['menunggu_pembayaran', 'diproses', 'dikirim', 'selesai'])->default('menunggu_pembayaran');
    $table->string('metode_pembayaran')->nullable(); // Transfer, COD, dll
    $table->timestamps();
});

// Tabel order_items (detail item yang dibeli)
Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
    $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
    $table->integer('jumlah');
    $table->decimal('harga_satuan', 10, 2); // Harga saat checkout (antisipasi perubahan harga)
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
