@extends('layout')

@section('content')
<div class="container py-5">
    <!-- Judul -->
    <h1 class="text-center mb-5">PRODUK FAVORITE</h1>

    @if($favorites->isEmpty())
        <!-- Pesan jika favorit kosong -->
        <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
            <p class="text-muted text-center">Tidak ada barang di favorit.</p>
        </div>
    @else
        <!-- Daftar favorit -->
        <div class="row justify-content-center">
            @foreach ($favorites as $favorite)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">ID Favorite: {{ $favorite->id_favorite }}</h5>
                            <p class="card-text">Detail barang favorit akan ditambahkan di sini.</p>

                            @auth
                                <a href="#" class="btn btn-danger btn-sm">Hapus dari Favorit</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Custom CSS --}}
<style>
    /* Styling container untuk favorit kosong */
    .container {
        padding-top: 50px;
    }

    /* Styling card */
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.05);
    }

    /* Judul */
    h1 {
        font-size: 2rem;
        font-weight: bold;
        text-transform: uppercase;
        color: #333;
    }

    /* Styling pesan kosong */
    .text-muted {
        font-size: 1.2rem;
        color: #6c757d;
    }
</style>
@endsection
