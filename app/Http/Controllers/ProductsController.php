<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
    protected $products;

    public function __construct()
    {
        $this->products = new Product();
    }

    public function index()
    {
        $products = Product::with('category', 'favorites')->get();
        $favorites = Favorite::where('user_id', auth()->id())->get();
        $carts = Cart::where('user_id', auth()->id())->get();
        dd($carts);
        $newArr = $products->map(function($item) use (&$favorites) {
            $item['isFavorite'] = $favorites->firstWhere('product_id', $item->id) ? true : false;
            return $item;
        });

        $products = $newArr;
        
        // Tampilkan halaman buyer dengan data produk
        return view('pages.product.index', compact('products'));
        
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productname' => 'required',
            'cat_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $fileName = time() . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('images'), $fileName);
            $validatedData['photo'] = $fileName;
        }
        Product::create($validatedData);
        return redirect()->route('product.index')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::findOrFail($id);

        return view('pages.product.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Ambil semua kategori
        // Tampilkan view edit dengan data produk
        return view('pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'productname' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
            'cat_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Jika ada file foto baru, simpan file tersebut
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($product->photo && file_exists(public_path('images/' . $product->photo))) {
                unlink(public_path('images/' . $product->photo));
            }

            // Simpan foto baru ke dalam folder 'public/images'
            $photoName = time() . '.' . $request->file('photo')->getClientOriginalExtension(); // Membuat nama file unik
            $request->file('photo')->move(public_path('images'), $photoName); // Menyimpan gambar ke folder public/images

            // Menyimpan nama file foto baru ke dalam database
            $product->photo = $photoName;
        }

        // Perbarui data produk (termasuk gambar jika ada)
        $product->update([
            'productname' => $request->productname,
            'price' => $request->price,
            'description' => $request->description,
            'cat_id' => $request->cat_id, // Menyimpan kategori yang dipilih
        ]);

        // Redirect ke halaman index dan kirimkan pesan sukses
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }

    public function showForBuyers()
    {
        // dd(Auth::user());
        if (Auth::check()) {
            //  dd(Auth::user());
            // Ambil semua produk yang tersedia
            $products = Product::with('category')->get();

            // Tampilkan halaman buyer dengan data produk
            return view('pages.product.buyer', compact('products'));
        } else {
            // Jika pengguna tidak diautentikasi, arahkan kembali ke login
            return redirect()->route('login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }
    }
}
