<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product; // Pastikan model Product diimport
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Menampilkan daftar barang favorit
    public function index()
    {
        // Mengambil data favorit berdasarkan user yang sedang login
        $favorites = Favorite::with('product') // Mengambil data produk terkait
                            ->where('user_id', auth()->id()) // Mengambil favorit dari user yang login
                            ->get();

        // Mengirimkan data favorit ke view
        return view('favorites.index', compact('favorites'));
    }

    // Menambahkan barang ke favorit
    public function store(Request $request)
    {
        // Validasi ID produk
        $request->validate([
            'product_id' => 'required|exists:products,id', // Validasi produk
        ]);

        // Menambahkan produk ke favorit untuk user yang login
        Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke favorit!');
    }

    // Menghapus barang dari favorit
    public function destroy($id)
    {
        // Menghapus favorit berdasarkan ID dan user yang login
        $favorite = Favorite::where('id', $id)->where('user_id', auth()->id())->first();
        
        // Cek jika favorit ada, lalu hapus
        if ($favorite) {
            $favorite->delete();
            return redirect()->route('favorites.index')->with('success', 'Barang berhasil dihapus dari favorit!');
        }

        // Jika tidak ditemukan, redirect dengan pesan error
        return redirect()->route('favorites.index')->with('error', 'Favorit tidak ditemukan!');
    }
}
