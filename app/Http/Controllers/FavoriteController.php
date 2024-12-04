<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product; // Pastikan model Product diimport
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
{
    // Cek jika pengguna sudah login
    if (auth()->check()) {
        // Mengambil data favorit berdasarkan user yang sedang login
        $favorites = Favorite::with('product') // Mengambil data produk terkait
                            ->where('user_id', auth()->id()) // Mengambil favorit dari user yang login
                            ->get();

        // Mengirimkan data favorit ke view
        return view('favorites.index', compact('favorites'));
    } else {
        // Jika belum login, tampilkan halaman kosong dengan pesan
        return view('favorites.index', ['favorites' => [], 'isLoggedIn' => false]);
    }
}

    // Menambahkan barang ke favorit
    public function store(Request $request)
{
    // Validasi ID produk
    $request->validate([
        'product_id' => 'required|exists:products,id', // Validasi produk
    ]);

    // Cek apakah user sudah login
    if (!auth()->check()) {
        return redirect()->back()->with('error', 'Anda harus login untuk menambahkan ke favorit!');
    }

    // Menambahkan produk ke favorit untuk user yang login
    $favorite = Favorite::firstOrCreate([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id,
    ]);

    // Redirect dengan pesan sukses
    if ($favorite->wasRecentlyCreated) {
        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke favorit!');
    } else {
        return redirect()->back()->with('info', 'Barang sudah ada di daftar favorit!');
    }
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