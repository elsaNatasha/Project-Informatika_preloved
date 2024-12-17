@extends('layout')

@section('content')
<div class="container">
    <h3 align="center">My Cart</h3>
    <br>

    @if ($carts->isEmpty())
        <p class="text-center">Your cart is empty.</p>
    @else
        <div class="table-responsive">
            <form>
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                            <th>Select</th>
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
                                <td>
                                    Rp<span class="item-price" data-price="{{ $cart->product->price }}">
                                        {{ number_format($cart->product->price) }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" class="form-control text-center" 
                                               value="1" 
                                               min="1" 
                                               max="1" readonly>
                                    </form>
                                </td>
                                <td>
                                    Rp<span class="item-total">{{ number_format($cart->product->price) }}</span>
                                </td>
                                <td>
                                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Remove
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <input type="checkbox" class="item-select" data-price="{{ $cart->product->price }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Total Price Section -->
                <div class="text-center mt-3">
                    <strong>Total: Rp<span id="total-price"></span></strong>
                </div>
                
                <button type="submit" class="btn btn-success mt-2">Proceed to Checkout</button>
            </form>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.item-select');
        const totalPriceElement = document.getElementById('total-price');

        function calculateTotal() {
            let total = 0;
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.dataset.price);
                }
            });
            totalPriceElement.textContent = total.toFixed();
        }

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', calculateTotal);
        });
    });
</script>
@endpush

