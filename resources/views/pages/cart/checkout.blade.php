@extends('layout')

@section('content')
<div class="container">
    <h3 align="center">Checkout</h3>
    <br>

    <form action="{{ route('checkout.submit') }}" method="POST">
        @csrf

        <!-- User Info -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>

        <!-- Order Details -->
        <h5>Order Details</h5>
        <ul class="list-group mb-3">
            @foreach ($selectedProducts as $product)
                <li class="list-group-item">
                    Product ID: {{ $product }}
                </li>
            @endforeach
        </ul>

        <!-- Total Price -->
        <div class="mb-3">
            <strong>Total Price: Rp {{ number_format($totalPrice) }}</strong>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
    </form>
</div>
@endsection
