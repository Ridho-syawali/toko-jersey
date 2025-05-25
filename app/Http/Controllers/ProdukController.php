<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Tampilkan semua produk
    public function index()
    {
        $data=[
            'produk' => Produk::all(),
        ];
        return view('products.products', $data);
        // return response()->json(Produk::all());
    }

    // Tampilkan produk berdasarkan id
    public function show($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return view('products.detail',$produk)->with('error', 'Produk tidak ditemukan');
        // return response()->json($produk);
    }
}
}
