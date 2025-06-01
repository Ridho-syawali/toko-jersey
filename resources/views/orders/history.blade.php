@extends('layouts.app')

@section('title', 'Riwayat Order - JerseyVerse')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Riwayat Order</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        @if($orders->isEmpty())
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <p class="text-gray-500">Anda belum memiliki order.</p>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                @foreach($orders as $order)
                <div class="p-6 border-b">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
                        <div>
                            <h2 class="font-bold text-lg">Order #{{ $order->kode_order }}</h2>
                            <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="mt-2 md:mt-0">
                            @php
                                $statusClass = [
                                    'menunggu_pembayaran' => 'bg-yellow-100 text-yellow-800',
                                    'diproses' => 'bg-blue-100 text-blue-800',
                                    'dikirim' => 'bg-green-100 text-green-800',
                                    'selesai' => 'bg-gray-100 text-gray-800',
                                ][$order->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex justify-between">
                            <span>Total Pembayaran:</span>
                            <span class="font-bold">Rp {{ number_format($order->total_harga,0,',','.') }}</span>
                        </div>
                    </div>
                    
                    <!-- Tombol untuk toggle dropdown -->
                    <button type="button" 
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-4"
                            onclick="toggleOrderDetails('order-details-{{ $order->id }}')">
                        Lihat Detail Order ({{ $order->items->count() }} items)
                    </button>
                    
                    <!-- Dropdown detail order -->
                    <div id="order-details-{{ $order->id }}" class="hidden border-t pt-4 mt-4">
                        <h3 class="font-semibold mb-3">Detail Produk:</h3>
                        
                        <div class="space-y-4">
                            @forelse($order->items as $item)
                                <div class="flex items-start border-b pb-4">
                                    <div class="w-20 h-20 bg-gray-100 rounded-md overflow-hidden mr-4">
                                        @if($item->produk && $item->produk->gambar)
                                            <img src="{{ asset('images/' . $item->produk->gambar) }}" 
                                                 alt="{{ $item->produk->nama ?? 'Produk' }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium">{{ $item->produk->nama_jersey ?? 'Produk tidak tersedia' }}</h4>
                                        <p class="text-sm text-gray-500">Ukuran: {{ $item->ukuran ?? '-' }}</p>
                                        <p class="text-sm text-gray-500">Jumlah: {{ $item->jumlah }}</p>
                                        <p class="text-sm text-gray-500">Harga: Rp {{ number_format($item->produk->harga,0,',','.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">Tidak ada item dalam order ini.</p>
                            @endforelse
                        </div>
                        
                        <div class="mt-6">
                            <h3 class="font-semibold mb-2">Informasi Pengiriman:</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm"><span class="font-medium">Nama:</span> {{ $order->user_id }}</p>
                                    <p class="text-sm"><span class="font-medium">Nama:</span> {{ $order->nama_user }}</p>
                                </div>
                                <div>
                                    <p class="text-sm"><span class="font-medium">Alamat:</span> {{ $order->alamat_pengiriman }}</p>
                                    <p class="text-sm"><span class="font-medium">Kurir:</span> {{ strtoupper($order->kurir) }} - {{ $order->service }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center mt-4">
                        @if($order->status == 'dikirim')
                        <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                                Tandai Selesai
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    function toggleOrderDetails(id) {
        const element = document.getElementById(id);
        element.classList.toggle('hidden');
    }
</script>
@endsection