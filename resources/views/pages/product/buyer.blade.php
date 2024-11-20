@extends('layout')

@section('content')
<div class="container">
    <h3 align="center">Products</h3>
    <br>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm" style="border-radius: 10px;">
                    @if ($product->photo)
                        <img src="{{ asset('images/' . $product->photo) }}" class="card-img-top" alt="Product image">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Default image">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->productname }}</h5>
                        <p class="card-text">
                            <strong>Category:</strong> {{ $product->category->name }} <br>
                            <strong>Description:</strong> {{ $product->description }} <br>
                            <strong>Price:</strong> ${{ $product->price }}
                        </p>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-outline-secondary btn-sm mx-1">
                                <i class="fa fa-heart"></i> Like
                            </button>
                            <button class="btn btn-outline-primary btn-sm mx-1">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
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
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 150px; /* Tinggi lebih kecil */
            width: 100%;
            object-fit: contain; /* Gambar tidak terpotong */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 10px; /* Mengecilkan padding body kartu */
        }
    </style>
@endpush
