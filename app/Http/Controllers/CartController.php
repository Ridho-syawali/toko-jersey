<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // Tampilkan isi cart user
    public function show()
    {
        $cart = Cart::with('items.produk')->firstOrCreate(['user_id' => auth()->id()]);
        // Kirim data cart ke view cart.cart
        return view('cart.cart', ['cart' => $cart]);
    }

    // Tambah produk ke cart
    public function add(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'ukuran' => 'nullable|string',
        ]);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $produk = Produk::findOrFail($request->produk_id);
        $item = CartItem::where('cart_id', $cart->id)
            ->where('produk_id', $produk->id)
            ->where('ukuran', $request->ukuran)
            ->first();
        if ($item) {
            $item->jumlah += $request->jumlah;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'produk_id' => $produk->id,
                'ukuran' => $request->ukuran,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $produk->harga,
            ]);
        }
        // Tambahkan notifikasi sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Halaman update ukuran item cart
    public function updatePage($itemId)
    {
        $item = \App\Models\CartItem::findOrFail($itemId);
        return view('cart.update', compact('item'));
    }

    // Update jumlah atau ukuran item di cart
    public function update(Request $request, $itemId)
    {
        $item = CartItem::findOrFail($itemId);
        if ($request->has('ukuran')) {
            $request->validate(['ukuran' => 'required|string']);
            $item->ukuran = $request->ukuran;
        }
        if ($request->has('jumlah')) {
            $request->validate(['jumlah' => 'required|integer|min:1']);
            $item->jumlah = $request->jumlah;
        }
        $item->save();
        return redirect()->route('cart')->with('success', 'Item berhasil diupdate!');
    }

    // Hapus item dari cart
    public function remove($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->delete();
        return redirect()->back();
    }

    // Terapkan kupon diskon
    public function applyCoupon(Request $request)
    {
        $request->validate(['coupon_code' => 'required|string']);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $diskon = 0;
        if (strtoupper($request->coupon_code) === 'DISKON50') {
            $diskon = 50000;
        }
        $cart->coupon_code = $request->coupon_code;
        $cart->discount = $diskon;
        $cart->save();
        return redirect()->back();
    }

    // Checkout: buat order dari cart
    // CartController.php
    public function checkout()
    {
        $cart = Cart::with('items.produk')->where('user_id', Auth::id())->first();
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        // Hanya redirect ke halaman checkout dengan data cart
        return view('checkout.show', compact('cart'));
    }
}
