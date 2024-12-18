@extends('admin')

@section('content')
<div class="container">
    <h2 class="text-center">Edit Product</h2>

    {{-- <form action="{{ route('product.update', $product->id) }}" method="POST"> --}}
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
    {{-- <form action="#" method="POST"> --}}
        @csrf
        @method('PUT')

        <!-- Nama Produk -->
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="productname" class="form-control" value="{{ old('productname', $product->productname) }}" required>
        </div>

        <!-- Harga -->
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
        </div>

        <!-- Deskripsi -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="5" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Kategori -->
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="cat_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->cat_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Jarak antara kategori dan tombol Update -->
        <div class="mt-4">
            <!-- Tombol Update Product -->
            <button type="submit" class="btn" style="background-color: #a15252; color: white; font-weight: bold;">
                Update Product
            </button>
            <a class="btn btn-secondary" href="{{ route('admin.products') }}">Cancel</a>
        </div>
    </form>
</div>
@endsection