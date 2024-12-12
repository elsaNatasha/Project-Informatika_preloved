@extends('layout')

@section('content')
<div class="container">
    <h3 align="center">Products</h3>
    <br>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm" style="border-radius: 10px;">
                    @if ($product->photo)
                        <img src="{{ asset('images/' . $product->photo) }}" class="card-img-top" alt="Product image">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Default image">
                    @endif
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $product->productname }}</h6>
                        <p class="card-text small">
                            <strong>Category:</strong> {{ $product->category->name }} <br>
                            <strong>Price:</strong> ${{ $product->price }}
                        </p>
                        <div class="d-flex justify-content-center">
                            {{-- Tombol Tambah ke Favorit --}}
                            <form action="{{ route('favorites.store') }}" method="POST" class="mx-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </form>

                            {{-- Tombol Tambah ke Keranjang --}}
                            <button class="btn btn-outline-primary btn-sm mx-1 add-to-cart" data-product-id="{{ $product->id }}">
                                <i class="fa fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($products->isEmpty())
        <p class="text-center mt-4">No products available at the moment.</p>
    @endif
</div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 200px; /* Maksimal lebar kartu lebih kecil */
            margin: auto;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 100px; /* Tinggi gambar lebih kecil */
            width: 100%;
            object-fit: contain; /* Gambar tidak terpotong */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 8px; /* Mengecilkan padding body kartu */
        }

        .card-title {
            font-size: 0.9rem; /* Ukuran font lebih kecil */
            font-weight: bold;
        }

        .card-text {
            font-size: 0.8rem; /* Ukuran font deskripsi lebih kecil */
        }

        .btn {
            font-size: 0.75rem; /* Ukuran tombol lebih kecil */
            padding: 4px 8px;
        }

        .container h3 {
            font-size: 1.5rem; /* Ukuran judul lebih kecil */
        }
    </style>
@endpush

@push('js')
    <script>
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');
                
                // Mengirim permintaan AJAX ke server
                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Mengirim token CSRF untuk proteksi
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Menampilkan pesan atau mengarahkan pengguna ke halaman cart
                    alert(data.message);  // Pesan sukses
                    window.location.href = '{{ route('cart.index') }}';  // Arahkan ke halaman cart
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error adding the product to your cart.');
                });
            });
        });
    </script>
@endpush
