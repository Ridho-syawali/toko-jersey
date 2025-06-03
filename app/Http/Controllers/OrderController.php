<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

        public function history()
    {
        $orders = Order::with('items.produk')
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(10);
                
        return view('orders.history', compact('orders'));
    }


    public function index()
{
    $orders = auth()->user()->orders()
                ->with('orderItems')
                ->latest()
                ->paginate(10);
                
    return view('orders.history', compact('orders'));
}

    public function complete($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        
        if ($order->status == 'dikirim') {
            $order->update([
                'status' => 'selesai',
                'tanggal_selesai' => now()
            ]);
            
            return redirect()->back()
                ->with('success', 'Order telah ditandai sebagai selesai!');
        }
        
        return redirect()->back()
            ->with('error', 'Order tidak dapat ditandai selesai.');
    }
}
