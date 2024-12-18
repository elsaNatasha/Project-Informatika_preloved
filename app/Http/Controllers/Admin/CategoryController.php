<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(){
        $this->category = new Category();
    }
    

    public function index(){
        $response['categories'] = $this->category->all();
        return view('pages.admin.categories.index')->with($response);
    }
    

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name',
            'status' => 'required'
        ], [
            'name.unique' => 'Nama kategori sudah tersedia. Masukkan kategori lain.'
        ]);
    
        // Simpan kategori jika validasi lolos
        Category::create($request->all());
    
        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy($id)
{
    $category = $this->category->findOrFail($id);
    $category->delete();
    
    // Tambahkan pesan flash
    session()->flash('success', 'Category berhasil dihapus!');
    return redirect()->route('admin.categories');

}

public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('pages.admin.categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|in:1,2',
    ]);

    $category = Category::findOrFail($id);
    $category->update($validatedData);

    // Flash message untuk notifikasi
    session()->flash('success', 'Category berhasil diperbarui!');
    return redirect()->route('admin.categories');
}
}