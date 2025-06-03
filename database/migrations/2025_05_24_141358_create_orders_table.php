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
      // Migration untuk orders
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->string('nama_user')->nullable();
        $table->string('kode_order')->unique();
        $table->decimal('subtotal', 12, 2);
        $table->decimal('diskon', 12, 2)->default(0);
        $table->decimal('ongkir', 12, 2);
        $table->decimal('total_harga', 12, 2);
        $table->string('status')->default('menunggu_pembayaran');
        $table->string('metode_pembayaran')->nullable();
        $table->text('alamat_pengiriman');
        $table->dateTime('tanggal_pembayaran')->nullable();
        $table->timestamps();
    });

    // Migration untuk order_items
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained();
        $table->foreignId('produk_id')->constrained();
        $table->integer('jumlah');
        $table->decimal('harga_satuan', 12, 2);
        $table->string('ukuran');
        $table->timestamps();
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
