@extends('layout')

@section('content')
<div class="container">
    <h3>Checkout</h3>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
        </div>
        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
        <input type="hidden" name="selected_products" value="{{ json_encode($selectedProducts) }}">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
