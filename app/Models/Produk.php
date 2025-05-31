<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
    'nama_jersey',
    'deskripsi',
    'merk',
    'harga',
    'stok',
    'gambar',
    ];

    
    // Relasi ke cart items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relasi ke order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Cek stok tersedia
    public function isAvailable($quantity)
    {
        return $this->stok >= $quantity;
    }

    // Format harga
    public function formattedPrice()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
