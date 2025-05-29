@extends('layouts.app')

@section('title', 'Detail Produk - JerseyVerse')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb Navigation -->
    <section class="bg-white py-4 shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="/products" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Produk</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail Jersey</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Detail Section -->
    <section class="container mx-auto px-4 py-12">
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-300">
                {{ session('error') }}
            </div>
        @endif
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Product Images -->
            <div class="w-full md:w-1/2">
                <!-- Main Image -->
                <div class="bg-white rounded-xl shadow-md p-4 mb-4">
                <img src="../images/{{ $produk->gambar }}" alt="{{ $produk->nama_jersey }}" class="w-full h-full object-contain aspect-video">
                </div>
                
            </div>
            
            <!-- Product Info -->
            <div class="w-full md:w-1/2">
                <div class="bg-white rounded-xl shadow-md p-6">
                
                    <h1 class="text-3xl font-bold mb-2">Home Jersey 2023</h1>
                
                    
                    <!-- Price -->
                    <div class="mb-6">
                        <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($produk->harga,0,',','.') }}</span>
                        <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($produk->harga+($produk->harga*22/100),0,',','.') }}</span>
                        <span class="bg-green-100 text-green-800 text-xs font-medium ml-2 px-2.5 py-0.5 rounded">22% OFF</span>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-700">
                            {{ $produk->deskripsi }}    
                        </p>
                    </div>
                    <!-- Quantity & Action Buttons -->
                    <div class="mb-6">
                        <form action="{{ url('/cart/add') }}" method="POST">
                            @csrf
                            <div class="flex items-center mb-4">
                                <span class="mr-3">Jumlah:</span>
                                <div class="flex items-center border rounded-lg overflow-hidden">
                                    <button type="button" class="px-3 py-1 bg-gray-200 hover:bg-gray-300" onclick="var qty=document.getElementById('qty');if(qty.value>1)qty.value--">-</button>
                                    <input type="number" id="qty" name="jumlah" value="1" min="1" class="w-12 text-center border-0 focus:ring-0">
                                    <button type="button" class="px-3 py-1 bg-gray-200 hover:bg-gray-300" onclick="var qty=document.getElementById('qty');qty.value++">+</button>
                                </div>
                                <span class="text-sm text-gray-500 ml-3">Stok tersedia: {{ $produk->stok ?? '-' }}</span>
                            </div>
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            <input type="hidden" name="gambar" value="{{ $produk->gambar }}">
                            <div class="mb-4">
                                <label class="block mb-1 font-semibold">Pilih Ukuran</label>
                                <select name="ukuran" class="border rounded-lg px-3 py-2 w-full">
                                    <option value="">Pilih Ukuran (Opsional)</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold transition flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Product Meta -->
                    <div class="border-t pt-4">
                        <div class="flex items-center text-sm text-gray-500 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            Kategori: Jersey Sepak Bola
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dikirim dari: Jakarta
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
</div>
@endsection