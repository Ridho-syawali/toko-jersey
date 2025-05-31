@extends('layouts.app')

@section('title', 'Checkout - JerseyVerse')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h1 class="text-2xl font-bold mb-6">Checkout</h1>
                
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4">Detail Order</h2>
                    <div class="border rounded-lg overflow-hidden">
                        <div class="bg-gray-100 p-3 font-semibold grid grid-cols-4">
                            <div>Produk</div>
                            <div class="text-center">Harga</div>
                            <div class="text-center">Jumlah</div>
                            <div class="text-right">Subtotal</div>
                        </div>
                        
                        @foreach($cart->items as $item)
                        <div class="p-3 border-b grid grid-cols-4 items-center">
                            <div class="flex items-center">
                                <img src="../images/{{ $item->produk->gambar }}" alt="{{ $item->produk->nama_jersey }}" class="w-16 h-16 object-contain mr-3">
                                <div>
                                    <h3 class="font-medium">{{ $item->produk->nama_jersey }}</h3>
                                    <p class="text-sm text-gray-500">Ukuran: {{ $item->ukuran }}</p>
                                </div>
                            </div>
                            <div class="text-center">Rp {{ number_format($item->harga_satuan,0,',','.') }}</div>
                            <div class="text-center">{{ $item->jumlah }}</div>
                            <div class="text-right">Rp {{ number_format($item->harga_satuan * $item->jumlah,0,',','.') }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="bg-gray-100 rounded-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Ringkasan Pembayaran</h2>
                    @php
                        $subtotal = $cart->items->sum(fn($i) => $i->jumlah * $i->harga_satuan);
                        $diskon = $cart->discount ?? 0;
                        $ongkir = 25000;
                        $total = $subtotal - $diskon + $ongkir;
                    @endphp
                    <div class="space-y-3">
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
                        <div class="border-t pt-3 mt-3 flex justify-between font-bold text-lg">
                            <span>Total Pembayaran</span>
                            <span>Rp {{ number_format($total,0,',','.') }}</span>
                        </div>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                    <input type="hidden" name="diskon" value="{{ $diskon }}">
                    <input type="hidden" name="total_pembayaran" value="{{ $total }}">
                        <label for="metode_pembayaran" class="block mb-2 font-medium">Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="w-full p-2 border rounded-lg" required>
                            <option value="">Pilih Metode</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="cod">COD (Bayar di Tempat)</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label for="alamat" class="block mb-2 font-medium">Alamat Pengiriman</label>
                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="w-full p-2 border rounded-lg" rows="3" required>{{ Auth::user()->alamat_pengiriman ?? '' }}</textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold transition">
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection