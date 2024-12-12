@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Barang Favorit</h1>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mendefinisikan variabel $isLoggedIn --}}
    @php
        $isLoggedIn = auth()->check(); // True jika pengguna login
    @endphp

    {{-- Jika pengguna belum login --}}
    @if (!$isLoggedIn)
        <div class="alert alert-warning">
            <p>Silakan <a href="{{ route('login') }}">login</a> untuk melihat atau menyimpan produk favorit Anda.</p>
        </div>
    @elseif($favorites->isEmpty())
        <div class="text-center">
            <p class="text-muted">Belum ada barang favorit. Tambahkan beberapa barang ke daftar favorit Anda!</p>
        </div>
    @else
        {{-- Daftar Barang Favorit --}}
        <div class="row g-4">
            @foreach ($favorites as $favorite)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        {{-- Gambar Produk --}}
                        @if($favorite->product->image)
                            <img src="{{ asset($favorite->product->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $favorite->product->name }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" 
                                 class="card-img-top" 
                                 alt="Default Image">
                        @endif

                        {{-- Detail Produk --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorite->product->name }}</h5>
                            <p class="card-text text-muted">{{ $favorite->product->description }}</p>
                            {{-- Tombol Tambah ke Favorit --}}
                            <form action="{{ route('favorite.store', $favorite->product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Tambah ke Favorit
                                </button>
                            </form>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="card-footer text-end">
                            <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini dari favorit?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus dari Favorit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #343a40;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        font-size: 2.5rem;
        color: #343a40;
    }

    p {
        font-size: 1rem;
        color: #6c757d;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        background-color: #ffffff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #e9ecef;
    }

    .card-title {
        font-size: 1.25rem;
        color: #495057;
    }

    .card-text {
        font-size: 0.9rem;
        color: #6c757d;
        line-height: 1.5;
    }

    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    /* Button Styles */
    .btn {
        font-size: 0.875rem;
        padding: 5px 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #ffffff;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
        color: #ffffff;
    }

    /* Alert Styles */
    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        h1 {
            font-size: 2rem;
        }

        .card-img-top {
            height: 150px;
        }

        .btn {
            font-size: 0.8rem;
            padding: 5px 8px;
        }
    }
</style>
@endsection
