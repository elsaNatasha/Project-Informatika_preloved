@extends('layout')

@section('content')
<div class="container">
    <h1>Detail Barang Favorit</h1>
    <div class="card">
        <img src="{{ $favorite->product->image }}" class="card-img-top" alt="{{ $favorite->product->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $favorite->product->name }}</h5>
            <p class="card-text">{{ $favorite->product->description }}</p>
            <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($favorite->product->price, 0, ',', '.') }}</p>
        </div>
    </div>
</div>
@endsection
