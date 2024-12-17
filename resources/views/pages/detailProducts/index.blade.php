@extends('layout')

@section('content')
<div class="container">
    <h3 align="center">Input Products</h3>
    <br>

    <!-- Menampilkan notifikasi jika ada pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="form-area">
                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="productname">
                        </div>

                        <div class="col-md-6">
                            <label>Category</label>
                            <select name="cat_id" id="cat_id" class="form-control">
                                @foreach ($categories as $id => $name )
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description">
                        </div>

                        <div class="col-md-6">
                            <label>Price</label>
                            <input type="decimal" class="form-control" name="price">
                        </div>

                        <div class="col-md-6">
                            <label>Image</label>
                            <input class="form-control" name="photo" type="file" id="photo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn" value="Tambahkan" style="background-color: #a15252; color: white; font-weight: bold;">
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Tabel Produk -->
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th> <!-- Tambahkan kolom Deskripsi -->
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $product)
            <tr>
                <td scope="col">{{ ++$key }}</td>
                <td scope="col">{{ $product->productname }}</td>
                <td scope="col">{{ $product->category->name }}</td>
                <td scope="col">{{ $product->description }}</td> <!-- Tambahkan deskripsi produk -->
                <td scope="col">{{ $product->price }}</td>
                <td scope="col">
                    @if ($product->photo)
                        <img src="{{ asset('images/' . $product->photo) }}" alt="Product image" width="100"> 
                    @else
                        <img src="{{ asset('images/default.jpg') }}" alt="Default image" width="100"> 
                    @endif
                </td>
                <td scope="col">
                    <a href="{{ route('product.edit', $product->id) }}">
                        <button class="btn btn-secondary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
                        </button>
                    </a>
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>        
        @endforeach
    </tbody>                
</table>
        </div>
    </div>
</div>
@endsection

@push('css')
    <style>
        .form-area {
            padding: 20px;
            margin-top: 20px;
            background-color: white;
        }
    </style>
@endpush

@push('scripts')
<script>
    function confirmDelete() {
        return confirm('Apakah ingin menghapus?');
    }
</script>
@endpush
