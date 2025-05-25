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
                <p class="text-gray-600">Menampilkan 12 produk</p>
            </div>
            
            <div class="flex flex-col md:flex-row gap-4">
                <select class="px-4 py-2 border rounded-lg bg-white">
                    <option>Filter Kategori</option>
                    <option>Jersey Sepak Bola</option>
                    <option>Jersey Basket</option>
                    <option>Jersey E-sports</option>
                </select>
                
                <select class="px-4 py-2 border rounded-lg bg-white">
                    <option>Urutkan</option>
                    <option>Termurah</option>
                    <option>Termahal</option>
                    <option>Terbaru</option>
                </select>
            </div>
        </div>
    </section>

    <!-- Daftar Produk -->
    <section class="container mx-auto px-4 pb-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Produk 1 -->
            <!-- Contoh untuk Produk 1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <a href="{{ route('product.detail', 1) }}" class="block">
                    <div class="relative">
                        <img src="https://via.placeholder.com/300x300" alt="Jersey Home" class="w-full h-64 object-cover">
                        <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">HOT</span>
                    </div>
                </a>
                <div class="p-4">
                    <a href="{{ route('product.detail', 1) }}" class="block">
                        <h3 class="text-lg font-semibold hover:text-blue-600">Home Jersey 2023</h3>
                    </a>
                    <span class="text-blue-600 font-bold">Rp 350.000</span>
                    <p class="text-gray-500 text-sm mb-4">Official Match Version</p>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
                        + Keranjang
                    </button>
                </div>
            </div>

            <!-- Produk 2 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <div class="relative">
                    <img src="https://via.placeholder.com/300x300" alt="Jersey Away" class="w-full h-64 object-cover">
                    <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">NEW</span>
                </div>
                <div class="p-4 ">
                    <h3 class="text-lg font-semibold">Away Jersey 2023</h3>
                    <span class="text-blue-600 font-bold">Rp 375.000</span>
                    <p class="text-gray-500 text-sm mb-4">Player Version</p>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
                        + Keranjang
                    </button>
                </div>
            </div>

            <!-- Produk 3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <img src="https://via.placeholder.com/300x300" alt="Jersey Third" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Third Jersey 2023</h3>
                    <span class="text-blue-600 font-bold">Rp 325.000</span>
                    <p class="text-gray-500 text-sm mb-4">Limited Edition</p>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
                        + Keranjang
                    </button>
                </div>
            </div>

            <!-- Produk 4 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <img src="https://via.placeholder.com/300x300" alt="Jersey Retro" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Retro Jersey 1998</h3>
                    <span class="text-blue-600 font-bold">Rp 400.000</span>
                    <p class="text-gray-500 text-sm mb-4">Classic Edition</p>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
                        + Keranjang
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <nav class="flex items-center space-x-2">
                <a href="#" class="px-4 py-2 border rounded-lg bg-blue-600 text-white">1</a>
                <a href="#" class="px-4 py-2 border rounded-lg hover:bg-gray-100">2</a>
                <a href="#" class="px-4 py-2 border rounded-lg hover:bg-gray-100">3</a>
                <a href="#" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Next</a>
            </nav>
        </div>
    </section>
</div>
@endsection