<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Tampilkan semua produk
    public function index(Request $request)
    {
        $query = Produk::query();

        // Filter kategori jika ada
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Sorting
        if ($request->sort == 'termurah') {
            $query->orderBy('harga', 'asc');
        } elseif ($request->sort == 'termahal') {
            $query->orderBy('harga', 'desc');
        } elseif ($request->sort == 'terbaru') {
            $query->orderBy('created_at', 'desc');
        }

        $data = [
            'produk' => $query->get(),
        ];
        return view('products.products', $data);
        // return response()->json(Produk::all());
    }

    // Tampilkan produk berdasarkan id
    public function show($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return view('products.detail', ['produk' => null])->with('error', 'Produk tidak ditemukan');
        } else {
            return view('products.detail', ['produk' => $produk]);
        }
    }
}
