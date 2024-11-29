<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Simpan data ke tabel charts
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->product_id = $request->product_id;
        $cart->save();

        return response()->json(['message' => 'Product added to cart successfully!'], 200);
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);

        // Pastikan hanya user yang sesuai yang bisa menghapus
        if ($cart->user_id != auth()->id()) {
            return redirect()->route('cart.index')->withErrors('Unauthorized action.');
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function index()
    {
        // Ambil item keranjang pengguna saat ini dengan relasi produk
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();

        // Tampilkan halaman keranjang
        return view('cart.index', compact('carts'));
    }


}
