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
            
            <!-- Cart Item 1 -->
            <div class="p-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:grid md:grid-cols-12 gap-4">
                    <!-- Product Info -->
                    <div class="flex items-center col-span-5">
                        <img src="https://via.placeholder.com/80x80" alt="Home Jersey 2023" class="w-20 h-20 object-cover rounded-lg mr-4">
                        <div>
                            <h3 class="font-medium">Home Jersey 2023</h3>
                            <p class="text-sm text-gray-500">Ukuran: L</p>
                        </div>
                    </div>
                    
                    <!-- Price -->
                    <div class="col-span-2 text-center">
                        <span class="md:hidden font-medium">Harga: </span>
                        <span>Rp 350.000</span>
                    </div>
                    
                    <!-- Quantity -->
                    <div class="col-span-2">
                        <div class="flex items-center justify-center">
                            <button class="px-3 py-1 bg-gray-200 rounded-l-lg">-</button>
                            <span class="px-4 py-1 border-t border-b border-gray-200">1</span>
                            <button class="px-3 py-1 bg-gray-200 rounded-r-lg">+</button>
                        </div>
                    </div>
                    
                    <!-- Subtotal -->
                    <div class="col-span-2 text-center">
                        <span class="md:hidden font-medium">Subtotal: </span>
                        <span class="font-semibold">Rp 350.000</span>
                    </div>
                    
                    <!-- Remove -->
                    <div class="col-span-1 text-center">
                        <button class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Cart Item 2 -->
            <div class="p-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:grid md:grid-cols-12 gap-4">
                    <!-- Product Info -->
                    <div class="flex items-center col-span-5">
                        <img src="https://via.placeholder.com/80x80" alt="Away Jersey 2023" class="w-20 h-20 object-cover rounded-lg mr-4">
                        <div>
                            <h3 class="font-medium">Away Jersey 2023</h3>
                            <p class="text-sm text-gray-500">Ukuran: M</p>
                        </div>
                    </div>
                    
                    <!-- Price -->
                    <div class="col-span-2 text-center">
                        <span class="md:hidden font-medium">Harga: </span>
                        <span>Rp 375.000</span>
                    </div>
                    
                    <!-- Quantity -->
                    <div class="col-span-2">
                        <div class="flex items-center justify-center">
                            <button class="px-3 py-1 bg-gray-200 rounded-l-lg">-</button>
                            <span class="px-4 py-1 border-t border-b border-gray-200">1</span>
                            <button class="px-3 py-1 bg-gray-200 rounded-r-lg">+</button>
                        </div>
                    </div>
                    
                    <!-- Subtotal -->
                    <div class="col-span-2 text-center">
                        <span class="md:hidden font-medium">Subtotal: </span>
                        <span class="font-semibold">Rp 375.000</span>
                    </div>
                    
                    <!-- Remove -->
                    <div class="col-span-1 text-center">
                        <button class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Cart Summary -->
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Coupon Code -->
            <div class="w-full md:w-1/2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Kupon Diskon</h3>
                    <div class="flex">
                        <input type="text" placeholder="Masukkan kode kupon" class="flex-1 px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button class="bg-blue-600 text-white px-6 py-2 rounded-r-lg hover:bg-blue-700 transition">Gunakan</button>
                    </div>
                </div>
            </div>
            
            <!-- Cart Total -->
            <div class="w-full md:w-1/2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Ringkasan Belanja</h3>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>Rp 725.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Diskon</span>
                            <span class="text-green-600">- Rp 50.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Pengiriman</span>
                            <span>Rp 25.000</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span>Rp 700.000</span>
                        </div>
                    </div>
                    
                    <!-- Checkout Button -->
                    <button 
                        id="checkout-button"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold transition"
                    >
                        Proses Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="checkout-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Validasi Pembayaran</h3>
            <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="mb-6">
            <p class="mb-4">Berikut detail pesanan Anda:</p>
            
            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                <div class="flex justify-between mb-2">
                    <span class="font-medium">Home Jersey 2023 (L)</span>
                    <span>Rp 350.000</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-medium">Away Jersey 2023 (M)</span>
                    <span>Rp 375.000</span>
                </div>
                <div class="flex justify-between font-bold border-t pt-2 mt-2">
                    <span>Total Pembayaran</span>
                    <span>Rp 725.000</span>
                </div>
            </div>
            
            <p class="text-sm text-gray-600">Pastikan alamat pengiriman dan metode pembayaran sudah benar.</p>
        </div>
        
        <div class="flex justify-end space-x-3">
            <button id="cancel-checkout" class="px-6 py-2 border rounded-lg hover:bg-gray-100">Batal</button>
            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Konfirmasi Pembayaran</button>
        </div>
    </div>
</div>

<!-- JavaScript untuk Modal -->
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutButton = document.getElementById('checkout-button');
        const checkoutModal = document.getElementById('checkout-modal');
        const closeModal = document.getElementById('close-modal');
        const cancelCheckout = document.getElementById('cancel-checkout');
        
        checkoutButton.addEventListener('click', function() {
            checkoutModal.classList.remove('hidden');
        });
        
        closeModal.addEventListener('click', function() {
            checkoutModal.classList.add('hidden');
        });
        
        cancelCheckout.addEventListener('click', function() {
            checkoutModal.classList.add('hidden');
        });
        
        // Tutup modal saat klik di luar modal
        window.addEventListener('click', function(event) {
            if (event.target === checkoutModal) {
                checkoutModal.classList.add('hidden');
            }
        });
    });
</script>
@endsection
@endsection