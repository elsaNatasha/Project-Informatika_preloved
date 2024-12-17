@extends('layout')

@section('content')
<div class="container">
    <h3 align="center">My Cart</h3>
    <br>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                                <input type="number" class="form-control text-center" value="1" min="1" max="1" readonly>
                            </td>
                            <td>
                                Rp <span class="item-total">{{ number_format($cart->product->price) }}</span>
                            </td>
                            <td>
                                <!-- Form untuk Menghapus Produk -->
                                <form action="{{ route('carts.destroy', $cart->id) }}" method="POST" style="display: inline-block;"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini dari keranjang?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fa fa-trash"></i> Remove
                                    </button>
                                </form>
                            </td>
                            <td>
                                <!-- Checkbox untuk Memilih Produk -->
                                <input type="checkbox" class="item-select" 
                                       name="selected_products[]" 
                                       value="{{ $cart->product->id }}" 
                                       data-price="{{ $cart->product->price }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Form untuk Checkout -->
            {{-- <form action="{{ route('checkout.process') }}" method="POST"> --}}
            <form action="#" method="POST">
                @csrf
                <!-- Total Price Section -->
                <div class="text-center mt-3">
                    <strong>Total: <span id="total-price"></span></strong>
                </div>

                <!-- Checkout Button -->
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Checkout</button>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.item-select');
        const totalPriceElement = document.getElementById('total-price');
        const hiddenTotalPriceElement = document.getElementById('hidden-total-price');
        const hiddenSelectedProductsElement = document.getElementById('hidden-selected-products');

        function calculateTotal() {
            let total = 0;
            const selectedProducts = [];

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.dataset.price);
                    selectedProducts.push(checkbox.value);
                }
            });

            totalPriceElement.textContent = total.toLocaleString('id-ID');
            hiddenTotalPriceElement.value = total;
            hiddenSelectedProductsElement.value = JSON.stringify(selectedProducts);
        }

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', calculateTotal);
        });

        calculateTotal();
    });
</script>
@endpush

