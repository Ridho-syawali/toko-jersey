<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function checkout()
    {
        $cart = Cart::with('items')->where('user_id', Auth::id())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }
        DB::beginTransaction();
        try {
            $order = \App\Models\Order::create([
                'user_id' => Auth::id(),
                'kode_order' => 'JRS-' . now()->format('Ymd-His'),
                'total_harga' => $cart->items->sum(fn($i) => $i->jumlah * $i->harga_satuan) - $cart->discount,
                'status' => 'menunggu_pembayaran',
                'metode_pembayaran' => null,
            ]);
            foreach ($cart->items as $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->harga_satuan,
                ]);
            }
            $cart->items()->delete();
            $cart->coupon_code = null;
            $cart->discount = 0;
            $cart->save();
            DB::commit();
            // Redirect ke download invoice setelah checkout
            return redirect()->to(url('/invoice/' . $order->id));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}
