@extends('layouts.app')

@section('title', 'Products - JerseyVerse')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Banner Produk -->
    <section class="relative bg-blue-800 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Koleksi Jersey Kami</h1>
            <p class="text-xl max-w-2xl mx-auto">Temukan jersey berkualitas tinggi dengan desain eksklusif</p>
        </div>
    </section>

    <!-- Filter dan Sorting -->
    <section class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-semibold">Semua Produk</h2>
                <p class="text-gray-600">Menampilkan {{ count($produk) }} produk</p>
            </div>
            <form method="GET" class="flex flex-col md:flex-row gap-4">
                <select name="kategori" class="px-4 py-2 border rounded-lg bg-white">
                    <option value="">Filter Kategori</option>
                    <option value="sepakbola" {{ request('kategori') == 'sepakbola' ? 'selected' : '' }}>Jersey Sepak Bola</option>
                    <option value="basket" {{ request('kategori') == 'basket' ? 'selected' : '' }}>Jersey Basket</option>
                    <option value="esports" {{ request('kategori') == 'esports' ? 'selected' : '' }}>Jersey E-sports</option>
                </select>
                <select name="sort" class="px-4 py-2 border rounded-lg bg-white">
                    <option value="">Urutkan</option>
                    <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                    <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Termahal</option>
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Terapkan</button>
            </form>
        </div>
    </section>

    <!-- Daftar Produk -->
    <section class="container mx-auto px-4 pb-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Produk 1 -->
            @foreach($produk as $product)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <a href="{{ route('products.show', $product->id) }}" rel="noopener noreferrer" class="class="block">
                    <div class="relative">
                        <img src="{{ $product->gambar }}" alt="{{ $product->nama_jersey }}" class="w-full h-64 object-cover">
                    </div>
                </a>
                <div class="p-4">
                    <a href="{{ route('products.show', $product->id) }}" class="block">
                        <h3 class="text-lg font-semibold hover:text-blue-600 min-h-14 line-clamp-2">{{ $product->nama_jersey }}</h3>
                    </a>
                    <span class="text-blue-600 font-bold">Rp {{ $product->harga }}</span>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $product->deskripsi }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection