<?php

namespace App\Http\Controllers;

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
        return view('pages.category.index')->with($response);
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
    
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function destroy($id)
{
    $category = $this->category->findOrFail($id);
    $category->delete();
    return redirect()->route('category.index')->with('success', 'Category deleted successfully');
}

}
