<div class="container mt-4">
    <h4 class="text-center">Checkout Details</h4>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <!-- Detail Pengguna -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Your full name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Your phone number" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Your shipping address" required></textarea>
        </div>

        <!-- Produk Terpilih dan Total Harga -->
        <input type="hidden" name="selected_products" value="{{ json_encode($selectedProducts) }}">
        <input type="hidden" name="total_price" value="{{ $totalPrice }}">

        <!-- Checkout Button -->
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Checkout</button>
        </div>
    </form>
</div>
