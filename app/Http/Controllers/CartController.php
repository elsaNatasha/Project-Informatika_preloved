<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Cek apakah produk sudah ada di keranjang pengguna
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();

        if ($existingCart) {
            return response()->json(['message' => 'Product already in cart!'], 200);
        }

        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('products.buyers')->with('success', 'Berhasil tambah ke keranjang');

        // Menyimpan data produk ke keranjang
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->product_id = $request->product_id;
        $cart->save();

        // Debugging
    //    dd($cart);

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
            // Debugging: Lihat isi data keranjang
          //dd($carts);

            // Tampilkan halaman keranjang
            return view('pages.cart.index', compact('carts'));
        }
    
    public function update(Request $request, $id)
        {
            // Validasi kuantitas
            $request->validate([
                'quantity' => 'required|integer:1',
            ]);
        
            // Temukan item keranjang berdasarkan ID
            $cart = Cart::findOrFail($id);
        
            // Pastikan item ini milik pengguna yang sedang login
            if ($cart->user_id != auth()->id()) {
                return redirect()->route('cart.index')->withErrors('Unauthorized action.');
            }
        
            // Update kuantitas
            //$cart->quantity = 1;
            //$cart->save();
        
            // Kembali ke halaman keranjang dengan pesan sukses
            return redirect()->route('cart.index')->with('success', 'Quantity updated to 1.');
        }

        public function checkout(Request $request)
        {
            // Ambil produk yang dipilih oleh pengguna untuk checkout
            $selectedProductIds = $request->input('selected_products');
            
            // Validasi jika tidak ada produk yang dipilih
            if (!$selectedProductIds) {
                return redirect()->route('cart.index')->withErrors('No products selected for checkout.');
            }
            
            // Ambil produk yang dipilih dari database
            $selectedProducts = Cart::whereIn('id', $selectedProductIds)
                                    ->where('user_id', auth()->id())
                                    ->with('product')
                                    ->get();
            
            // Jika produk tidak valid
            if ($selectedProducts->isEmpty()) {
                return redirect()->route('cart.index')->withErrors('Invalid selection.');
            }

            // Kirim data produk yang dipilih ke halaman checkout
            return view('cart.index', compact('selectedProducts'));
        }

}
