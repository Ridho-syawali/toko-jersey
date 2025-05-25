<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'nama_jersey' => 'Jersey Barcelona Home 2023',
                'deskripsi' => 'Jersey kandang FC Barcelona musim 2023/2024, bahan breathable',
                'merk' => 'Nike',
                'harga' => 899000,
                'stok' => 50,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jersey' => 'Jersey Real Madrid Away 2023',
                'deskripsi' => 'Jersey tandang Real Madrid warna hitam musim 2023/2024',
                'merk' => 'Adidas',
                'harga' => 850000,
                'stok' => 45,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jersey' => 'Jersey Liverpool Third Kit 2023',
                'deskripsi' => 'Jersey ketiga Liverpool warna ungu dengan desain modern',
                'merk' => 'Nike',
                'harga' => 825000,
                'stok' => 30,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jersey' => 'Jersey Manchester United Home 2023',
                'deskripsi' => 'Jersey kandang MU merah dengan stripe vertikal',
                'merk' => 'Adidas',
                'harga' => 875000,
                'stok' => 40,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jersey' => 'Jersey Chelsea Away 2023',
                'deskripsi' => 'Jersey tandang Chelsea warna biru muda dengan pola abstrak',
                'merk' => 'Nike',
                'harga' => 845000,
                'stok' => 35,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jersey' => 'Jersey AC Milan Home 2023',
                'deskripsi' => 'Jersey kandang AC Milan garis merah-hitam klasik',
                'merk' => 'Puma',
                'harga' => 795000,
                'stok' => 25,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jersey' => 'Jersey PSG Third Kit 2023',
                'deskripsi' => 'Jersey ketiga PSG warna merah marun dengan aksen emas',
                'merk' => 'Nike',
                'harga' => 925000,
                'stok' => 20,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jersey' => 'Jersey Bayern Munich Home 2023',
                'deskripsi' => 'Jersey kandang Bayern Munich merah dengan stripe diagonal',
                'merk' => 'Adidas',
                'harga' => 865000,
                'stok' => 30,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jersey' => 'Jersey Juventus Away 2023',
                'deskripsi' => 'Jersey tandang Juventus warna pink pastel dengan logo hitam',
                'merk' => 'Adidas',
                'harga' => 815000,
                'stok' => 15,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jersey' => 'Jersey Arsenal Home 2023',
                'deskripsi' => 'Jersey kandang Arsenal merah dengan lengan putih',
                'merk' => 'Adidas',
                'harga' => 855000,
                'stok' => 40,
                'gambar' => 'photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
