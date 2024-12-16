<form action="{{ route('checkout.uploadPaymentProof') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="order_id" value="{{ $order->id }}">

    <div class="form-group">
        <label for="payment_proof">Upload Payment Proof</label>
        <input type="file" name="payment_proof" id="payment_proof" class="form-control" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Upload Payment Proof</button>
</form>
