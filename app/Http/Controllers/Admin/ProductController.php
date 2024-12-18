<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        
        return view('pages.admin.products.index', compact('products', 'categories'));
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
        // dd($request->all());
        $request->validate([
            'productname' => 'required',
            'cat_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'required',
        ]);

        // dd($request->all());

        $image = $request->file('photo');

        // unique name
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        Product::create([
            'productname' => $request->productname,
            'cat_id' => $request->cat_id,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $imageName,
        ]);

        // Move to the public/ dir
        $image->move(public_path('images'), $imageName);
        
        return back()->with('success', 'Berhasil menambahkan produk!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Ambil semua kategori
        // Tampilkan view edit dengan data produk
        return view('pages.admin.products.edit', compact('product', 'categories'));
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
        // if ($request->hasFile('photo')) {
        //     // Hapus foto lama jika ada
        //     if ($product->photo && file_exists(public_path('images/' . $product->photo))) {
        //         unlink(public_path('images/' . $product->photo));
        //     }

        //     // Simpan foto baru ke dalam folder 'public/images'
        //     $photoName = time() . '.' . $request->file('photo')->getClientOriginalExtension(); // Membuat nama file unik
        //     $request->file('photo')->move(public_path('images'), $photoName); // Menyimpan gambar ke folder public/images

        //     // Menyimpan nama file foto baru ke dalam database
        //     $product->photo = $photoName;
        // }

        // Perbarui data produk (termasuk gambar jika ada)
        $product->update([
            'productname' => $request->productname,
            'price' => $request->price,
            'description' => $request->description,
            'cat_id' => $request->cat_id, // Menyimpan kategori yang dipilih
        ]);

        // Redirect ke halaman index dan kirimkan pesan sukses
        return redirect()->route('admin.products')->with('success', 'Produk berhasil diupdate!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus!');
    }
}
