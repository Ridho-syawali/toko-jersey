@extends('layouts.app')

@section('title', 'Keranjang Belanja - JerseyVerse')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Keranjang Belanja</h1>
        <!-- Cart Items -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <!-- Cart Header -->
            <div class="hidden md:grid grid-cols-12 bg-gray-100 p-4 font-semibold">
                <div class="col-span-5">Produk</div>
                <div class="col-span-2 text-center">Harga</div>
                <div class="col-span-2 text-center">Jumlah</div>
                <div class="col-span-2 text-center">Subtotal</div>
                <div class="col-span-1 text-center">Aksi</div>
            </div>
            @forelse($cart->items as $item)
            <div class="p-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:grid md:grid-cols-12 gap-4">
                    <!-- Product Info -->
                    <div class="flex items-center col-span-5">
                        <img src="{{ $item->produk->gambar ?? 'https://via.placeholder.com/80x80' }}" alt="{{ $item->produk->nama_jersey ?? '-' }}" class="w-20 h-20 object-cover rounded-lg mr-4">
                        <div>
                            <h3 class="font-medium">{{ $item->produk->nama_jersey ?? '-' }}</h3>
                            <p class="text-sm text-gray-500">Ukuran: {{ $item->ukuran ?? '-' }}</p>
                        </div>
                    </div>
                    <!-- Price -->
                    <div class="col-span-2 text-center">
                        <span class="md:hidden font-medium">Harga: </span>
                        <span>Rp {{ number_format($item->harga_satuan,0,',','.') }}</span>
                    </div>
                    <!-- Quantity -->
                    <div class="col-span-2">
                        <div class="flex items-center justify-center">
                            <form action="{{ url('/cart/update/'.$item->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="jumlah" value="{{ $item->jumlah - 1 }}">
                                <button type="submit" class="px-3 py-1 bg-gray-200 rounded-l-lg" @if($item->jumlah <= 1) disabled @endif>-</button>
                            </form>
                            <span class="px-4 py-1 border-t border-b border-gray-200">{{ $item->jumlah }}</span>
                            <form action="{{ url('/cart/update/'.$item->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="jumlah" value="{{ $item->jumlah + 1 }}">
                                <button type="submit" class="px-3 py-1 bg-gray-200 rounded-r-lg">+</button>
                            </form>
                        </div>
                    </div>
                    <!-- Subtotal -->
                    <div class="col-span-2 text-center">
                        <span class="md:hidden font-medium">Subtotal: </span>
                        <span class="font-semibold">Rp {{ number_format($item->jumlah * $item->harga_satuan,0,',','.') }}</span>
                    </div>
                    <!-- Remove & Update -->
                    <div class="col-span-1 text-center flex flex-col gap-2 items-center">
                        <form action="{{ url('/cart/remove/'.$item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                        <a href="{{ url('/cart/update-page/'.$item->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs mt-1" title="Update Ukuran">Update Ukuran</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-4 text-center text-gray-500">Keranjang kosong.</div>
            @endforelse
        </div>
        <!-- Cart Summary -->
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Coupon Code -->
            <div class="w-full md:w-1/2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Kupon Diskon</h3>
                    <form action="{{ url('/cart/apply-coupon') }}" method="POST" class="flex">
                        @csrf
                        <input type="text" name="coupon_code" placeholder="Masukkan kode kupon" class="flex-1 px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $cart->coupon_code }}">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-r-lg hover:bg-blue-700 transition">Gunakan</button>
                    </form>
                </div>
            </div>
            <!-- Cart Total -->
            <div class="w-full md:w-1/2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Ringkasan Belanja</h3>
                    @php
                        $subtotal = $cart->items->sum(fn($i) => $i->jumlah * $i->harga_satuan);
                        $diskon = $cart->discount ?? 0;
                        $ongkir = 25000;
                        $total = max($subtotal - $diskon + $ongkir, 0);
                    @endphp
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Diskon</span>
                            <span class="text-green-600">- Rp {{ number_format($diskon,0,',','.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Pengiriman</span>
                            <span>Rp {{ number_format($ongkir,0,',','.') }}</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span>Rp {{ number_format($total,0,',','.') }}</span>
                        </div>
                    </div>
                    <form action="{{ url('/cart/checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold transition">
                            Proses Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection