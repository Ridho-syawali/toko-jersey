@extends('layouts.app')

@section('title', 'Update Ukuran Produk')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 py-8">
    <div class="bg-white rounded-xl shadow-md p-8 w-full max-w-md text-center">
        <h1 class="text-2xl font-bold text-blue-600 mb-4">Update Ukuran Produk</h1>
        <form action="{{ url('/cart/update/' . $item->id) }}" method="POST" class="space-y-4">
            @csrf
            <div class="text-left">
                <label for="ukuran" class="block font-medium mb-1">Pilih Ukuran</label>
                <select name="ukuran" id="ukuran" class="w-full border rounded px-3 py-2">
                    <option value="S" {{ $item->ukuran == 'S' ? 'selected' : '' }}>S</option>
                    <option value="M" {{ $item->ukuran == 'M' ? 'selected' : '' }}>M</option>
                    <option value="L" {{ $item->ukuran == 'L' ? 'selected' : '' }}>L</option>
                    <option value="XL" {{ $item->ukuran == 'XL' ? 'selected' : '' }}>XL</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-white py-2 rounded-lg font-bold transition">Update Ukuran</button>
        </form>
        <a href="{{ route('cart') }}" class="inline-block mt-4 text-blue-600 hover:underline">Kembali ke Keranjang</a>
    </div>
</div>
@endsection
