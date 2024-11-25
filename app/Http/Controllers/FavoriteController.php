<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
{
    if (auth()->check()) {
        $favorites = Favorite::with('product')->where('user_id', auth()->id())->get();
    } else {
        $favorites = collect(); // Kosongkan daftar favorit untuk pengguna yang belum login
    }

    return view('favorites.index', compact('favorites'));
}
}