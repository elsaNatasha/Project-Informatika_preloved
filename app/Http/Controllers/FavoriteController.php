<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Menampilkan daftar favorit pengguna
    public function index()
    {
        // Cek jika pengguna sudah login
        if (auth()->check()) {
            // Mengambil data favorit berdasarkan user yang sedang login
            // $favorites = Favorite::with('product') // Mengambil relasi produk
            //                     ->where('user_id', auth()->id()) // Filter user yang login
            //                     ->get();

            $favorites = Favorite::join('products', 'products.id', '=', 'favorites.product_id')->where('user_id', auth()->id())
                ->select('favorites.id', 'products.productname', 'products.description', 'products.photo')->get();
            // dd($favorites);
            // Mengirimkan data favorit ke view
            return view('pages.favorites.index', compact('favorites'))->with('isLoggedIn', true);
        } else {
            // Jika belum login, tampilkan halaman kosong dengan pesan
            return view('favorites.index', ['favorites' => [], 'isLoggedIn' => false])
                ->with('message', 'Anda perlu login untuk melihat favorit Anda.');
        }
    }

    // Menambahkan atau menghapus produk dari favorit
    public function store(Request $request)
    {
        // dd($request->all());
        // Pastikan user login
        // if (!auth()->check()) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        $user = auth()->user();
        $productId = $request->product_id;

        // Cek apakah produk sudah ada di favorit
        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        // if ($favorite) {
        //     // Jika produk sudah ada di favorit, hapus dari favorit
        //     $favorite->delete();
        //     return response()->json(['success' => 'Produk dihapus dari favorit']);
        // } else {
        // Jika produk belum ada, tambahkan ke favorit
        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

        return redirect()->route('buyer.products')->with('success', 'Produk ditambahkan ke favorit');
        // return response()->json(['success' => 'Produk ditambahkan ke favorit']);
        // }
    }

    public function destroy($id)
    {
        // dd($id);
        // Menghapus favorit berdasarkan id dan user yang login
        $favorite = Favorite::where('id', $id)  // pastikan menggunakan 'id' bukan 'id_favorite'
            ->where('user_id', auth()->id())
            ->first();

        // Cek jika favorit ada, lalu hapus....
        if ($favorite) {
            $favorite->delete();
            return redirect()->route('favorites.index')->with('success', 'Barang berhasil dihapus dari favorit');
        }

        // Jika tidak ditemukan, redirect dengan pesan error
        return redirect()->route('favorites.index')->with('error', 'Favorit tidak ditemukan');
    }
}
