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

    {{-- Cek Apakah Ada Barang Favorit --}}
    @if($favorites->isEmpty())
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
@endsection
