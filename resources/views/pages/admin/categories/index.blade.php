@extends('admin')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h3 align="center">Daftar Kategori</h3>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="form-area">
                    <!-- Tampilkan pesan error -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <label>Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusTrue"
                                            value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusTrue">True</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusFalse"
                                            value="2" {{ old('status') == '2' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusFalse">False</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <input type="submit" class="btn" value="Tambahkan"
                                    style="background-color: #a15252; color: white; font-weight: bold;">
                            </div>
                        </div>

                </div>
                </form>
            </div>

            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td scope="col">{{ ++$key }}</td>
                            <td scope="col">{{ $category->name }}</td>
                            <td scope="col">
                                @if ($category->status == 1)
                                    true
                                @else
                                    false
                                @endif
                            </td>
                            <td scope="col">
                                {{-- <a href="{{ route('category.edit', $category->id) }}"> --}}
                                <a href="{{ route('admin.categories.edit', $category->id) }}">
                                    <button class="btn btn-secondary btn-sm">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
                                    </button>
                                </a>
                                {{-- <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline-block"  --}}
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirmDeletion(event, '{{ $category->name }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                <script>
                                    function confirmDeletion(event, categoryName) {
                                        const confirmation = confirm(Apakah benar ingin menghapus Kategori ? "${categoryName}" ? );
                                        const confirmation = confirm(`Apakah benar ingin menghapus Kategori? "${categoryName}"?`);

                                        if (!confirmation) {
                                            event.preventDefault(); // Mencegah pengiriman formulir jika pengguna membatalkan
                                        }
                                        return confirmation; // Hanya mengirim formulir jika pengguna mengonfirmasi
                                    }
                                </script>
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
