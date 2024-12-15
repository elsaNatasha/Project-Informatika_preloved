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

                            {{-- Tombol Love --}}
                            <button type="button" class="btn btn-sm love-btn {{ in_array($favorite->product->id, $favorites->pluck('product_id')->toArray()) ? 'btn-danger' : 'btn-outline-danger' }}" 
                                    data-product-id="{{ $favorite->product->id }}">
                                <i class="fas fa-heart"></i> Favorit
                            </button>
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

<!-- Add JQuery & Font Awesome for the heart icon -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.love-btn').click(function() {
            var productId = $(this).data('product-id');
            var button = $(this);
            
            $.ajax({
                url: '{{ route('favorite.store') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    if (response.success) {
                        // Toggle button color to red (favorited)
                        button.toggleClass('btn-danger btn-outline-danger');
                    } else {
                        alert('Gagal menambahkan ke favorit!');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    });
</script>

<style>
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-outline-danger {
        border: 1px solid #dc3545;
        color: #dc3545;
    }
</style>
@endsection
