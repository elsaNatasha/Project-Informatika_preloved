@extends('admin')

@section('content')
    <div class="container">
        <h3 align="center">Input Products</h3>
        <br>

        <!-- Menampilkan notifikasi jika ada pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="form-area">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="productname" value="{{ old('productname') }}">
                            </div>

                            <div class="col-md-6">
                                <label>Kategori</label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    <option selected disabled>Pilih kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                            </div>

                            <div class="col-md-6">
                                <label>Harga</label>
                                <input type="decimal" class="form-control" name="price" value="{{ old('price') }}">
                            </div>

                            <div class="col-md-6">
                                <label>Foto</label>
                                <input class="form-control" name="photo" type="file" id="photo" accept="image/*">
                            </div>
                            <div class="col-md-6" id="imgPreview">
                                {{-- <img src="#" alt="#"> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <input type="submit" class="btn" value="Tambahkan"
                                    style="background-color: #a15252; color: white; font-weight: bold;">
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
                                        <img src="{{ asset('images/' . $product->photo) }}" alt="Product image"
                                            width="100">
                                    @else
                                        <img src="{{ asset('images/default.jpg') }}" alt="Default image" width="100">
                                    @endif
                                </td>
                                <td scope="col">
                                    {{-- <a href="{{ route('product.edit', $product->id) }}"> --}}
                                    <a href="{{ route('admin.products.edit', $product->id) }}">
                                        <button class="btn btn-secondary btn-sm">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
                                        </button>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Konfirmasi hapus produk?')">Delete</button>
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
    <script>
        $(document).ready(function() {
            $('#photo').change(function() {
                if ($(this)[0].files.length > 0) {
                    var file = $(this)[0].files[0];

                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#imgPreview').empty();
                            $("#imgPreview").append(
                                `<img style="width: 50%;" id="previewImage" src="#" alt="Image Preview">`
                            );
                            $('#previewImage').attr('src', e.target.result).show();
                        };

                        reader.readAsDataURL(file);
                    }
                }
            });
        });
    </script>
@endpush
