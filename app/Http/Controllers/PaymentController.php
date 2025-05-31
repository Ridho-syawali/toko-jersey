<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class PaymentController extends Controller
{
    public function show($id)
    {
        $order = Order::with('items.produk')->where('user_id', Auth::id())->findOrFail($id);
        return view('checkout.show', compact('order'));
    }

    public function store(Request $request)
{
    try {
        // Validasi form dengan pesan error yang lebih deskriptif
        $validatedData = $request->validate([
            'metode_pembayaran' => 'required',
            'alamat_pengiriman' => 'required|string|min:10|max:255',
            'total_pembayaran' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ], [
            'metode_pembayaran.in' => 'Metode pembayaran yang dipilih tidak valid.',
            'alamat_pengiriman.min' => 'Alamat pengiriman terlalu pendek.',
        ]);

        // Ambil user yang sedang login
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil item cart dengan eager loading untuk optimasi query
        $cartItems = CartItem::with('produk')
            ->whereHas('cart', fn($query) => $query->where('user_id', $user->id))
            ->get();

        // Validasi cart items
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada item dalam keranjang belanja.');
        }

        // Mulai database transaction
        DB::beginTransaction();

        // Buat order baru
        $order = new Order();
        $order->user_id = $user->id;
        $order->nama_user = $user->name;
        $order->kode_order = Str::random(8) . '-' . time();
        $order->metode_pembayaran = $validatedData['metode_pembayaran'];
        $order->alamat_pengiriman = strip_tags($validatedData['alamat_pengiriman']); // Sanitasi input
        $order->subtotal = $validatedData['subtotal'];
        $order->diskon = $validatedData['diskon'] ?? 0;
        $order->ongkir = 25000; // biaya pengiriman (sebaiknya diambil dari service pengiriman)
        $order->total_harga = $validatedData['total_pembayaran'];
        $order->status = 'menunggu_pembayaran';
        $order->tanggal_pembayaran = now();
        $order->save();

        // Persiapkan data order items
        $orderItems = $cartItems->map(function ($item) use ($order) {
            return [
                'order_id' => $order->id,
                'produk_id' => $item->produk_id,
                'jumlah' => $item->jumlah,
                'harga_satuan' => $item->produk->harga,
                'ukuran' => $item->ukuran ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        // Bulk insert untuk optimasi performa
        OrderItem::insert($orderItems);

        // Hapus cart setelah order berhasil dibuat
        Cart::where('user_id', $user->id)->delete();

        // Commit transaction
        DB::commit();

        // Redirect dengan flash message
        return redirect()->route('orders.history')
            ->with('success', 'Order berhasil dibuat. Silakan lakukan pembayaran.');

    } catch (ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput();
            
    } catch (Exception $e) {
        // Rollback transaction jika terjadi error
        DB::rollBack();
        
        Log::error('Order creation failed: ' . $e->getMessage(), [
            'user_id' => auth()->id(),
            'exception' => $e
        ]);
        
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan saat membuat order. Silakan coba lagi.')
            ->withInput();
    }
}
}