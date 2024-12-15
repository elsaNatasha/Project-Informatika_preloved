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
                            {{-- Tombol Love --}}
                            <button type="button" class="btn btn-outline-secondary btn-sm love-btn" 
                                data-product-id="{{ $product->id }}" 
                                data-is-favorite="{{ $product->isFavorite() }}">
                                <i class="fa fa-heart"></i>
                            </button>

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
            max-width: 200px;
            margin: auto;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 100px;
            width: 100%;
            object-fit: contain;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 8px;
        }

        .card-title {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 0.8rem;
        }

        .btn {
            font-size: 0.75rem;
            padding: 4px 8px;
        }

        .container h3 {
            font-size: 1.5rem;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-outline-danger {
            border: 1px solid #dc3545;
            color: #dc3545;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.love-btn').click(function() {
                var productId = $(this).data('product-id');
                var button = $(this);
                var isFavorite = $(this).data('is-favorite') === true;

                $.ajax({
                    url: '{{ route('favorites.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        is_favorite: isFavorite
                    },
                    success: function(response) {
                        // Toggle the button color based on success
                        if (response.success) {
                            button.toggleClass('btn-danger btn-outline-danger');
                            button.data('is-favorite', !isFavorite);  // Update the state
                        } else {
                            alert('Gagal menambahkan atau menghapus produk dari favorit');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endpush
