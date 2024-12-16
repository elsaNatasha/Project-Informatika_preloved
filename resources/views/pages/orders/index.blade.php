@extends('layout')

@section('content')
<div class="container">
    <h3>Orders Waiting for Verification</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Payment Proof</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>
                        <a href="{{ asset('storage/payment_proofs/' . $order->payment_proof) }}" target="_blank">
                            View Proof
                        </a>
                    </td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('admin.orders.verify', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="status" value="processed">
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('admin.orders.verify', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
