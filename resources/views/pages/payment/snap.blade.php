@extends('layout')

@section('content')
<div class="container">
    <h3>Proceed to Payment</h3>
    <p>Click the button below to complete your payment.</p>

    <button id="pay-button" class="btn btn-success">Pay Now</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay("{{ $snapToken }}", {
            onSuccess: function (result) {
                console.log(result);
                alert("Payment successful!");
                window.location.href = '/success'; // Redirect ke halaman sukses
            },
            onPending: function (result) {
                console.log(result);
                alert("Payment is pending!");
            },
            onError: function (result) {
                console.log(result);
                alert("Payment failed!");
            },
            onClose: function () {
                alert("You closed the payment popup!");
            }
        });
    });
</script>
@endsection
