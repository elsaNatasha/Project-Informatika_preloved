<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product; // Pastikan model Product diimport
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Menampilkan daftar favorit pengguna
    public function index()
    {
        // Cek jika pengguna sudah login
        if (auth()->check()) {
            // Mengambil data favorit berdasarkan user yang sedang login
            $favorites = Favorite::with('product') // Mengambil relasi produk
                                ->where('user_id', auth()->id()) // Filter user yang login
                                ->get();

            // Mengirimkan data favorit ke view
            return view('favorites.index', compact('favorites'));
        } else {
            // Jika belum login, tampilkan halaman kosong
            return view('favorites.index', ['favorites' => [], 'isLoggedIn' => false]);
        }
    }

    // FavoriteController.php
public function store(Request $request)
{
    // Pastikan user login
    if (!auth()->check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $user = auth()->user();
    $productId = $request->product_id;

    // Cek apakah produk sudah ada di favorit
    $favorite = Favorite::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();

    if ($favorite) {
        // Jika produk sudah ada di favorit, hapus dari favorit
        $favorite->delete();
        return response()->json(['success' => 'Produk dihapus dari favorit']);
    } else {
        // Jika produk belum ada, tambahkan ke favorit
        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);
        return response()->json(['success' => 'Produk ditambahkan ke favorit']);
    }
}

    // Menghapus barang dari favorit
    public function destroy($id_favorite)
    {
        // Menghapus favorit berdasarkan id_favorite dan user yang login
        $favorite = Favorite::where('id_favorite', $id_favorite)
                            ->where('user_id', auth()->id())
                            ->first();
        
        // Cek jika favorit ada, lalu hapus
        if ($favorite) {
            $favorite->delete();
            return redirect()->route('favorites.index')->with('success', 'Barang berhasil dihapus dari favorit!');
        }

        // Jika tidak ditemukan, redirect dengan pesan error
        return redirect()->route('favorites.index')->with('error', 'Favorit tidak ditemukan!');
    }
}
