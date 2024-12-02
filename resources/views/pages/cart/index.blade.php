@extends('layout')

@section('content')
<div class="container">
    <h3 align="center">My Cart</h3>
    <br>

    @if ($carts->isEmpty())
        <p class="text-center">Your cart is empty.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($cart->product->photo)
                                        <img src="{{ asset('images/' . $cart->product->photo) }}" 
                                             alt="Product image" 
                                             style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                    @else
                                        <img src="{{ asset('images/default.jpg') }}" 
                                             alt="Default image" 
                                             style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                    @endif
                                    <span>{{ $cart->product->productname }}</span>
                                </div>
                            </td>
                            <td>${{ number_format($cart->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" class="form-control text-center" 
                                           value="{{ $cart->quantity }}" 
                                           min="1" 
                                           max="99">
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                                </form>
                            </td>
                            <td>${{ number_format($cart->product->price * $cart->quantity, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

@push('css')
<style>
    .table img {
        border-radius: 5px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
</style>
@endpush
