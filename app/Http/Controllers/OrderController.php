<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Tampilkan semua order
    public function index()
    {
        return response()->json(Order::with('items')->get());
    }

    // Tampilkan order berdasarkan id
    public function show($id)
    {
        $order = Order::with('items')->find($id);
        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }
        return response()->json($order);
    }

    // Membuat order baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kode_order' => 'required|unique:orders,kode_order',
            'total_harga' => 'required|numeric',
            'status' => 'required',
            'metode_pembayaran' => 'nullable',
            'items' => 'required|array',
            'items.*.produk_id' => 'required|exists:produks,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga_satuan' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create($validated);
            foreach ($validated['items'] as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }
            DB::commit();
            return response()->json($order->load('items'), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal membuat order', 'error' => $e->getMessage()], 500);
        }
    }

    // Update order
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }
        $validated = $request->validate([
            'status' => 'sometimes|required',
            'metode_pembayaran' => 'nullable',
        ]);
        $order->update($validated);
        return response()->json($order);
    }

    // Hapus order
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }
        $order->delete();
        return response()->json(['message' => 'Order berhasil dihapus']);
    }
}
