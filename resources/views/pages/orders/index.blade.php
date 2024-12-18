@extends('layout')
<style>
    tr:hover {
        cursor: pointer;
    }
</style>
@section('content')
    <div class="container">
        <h3 class="text-center">Pesanan Anda</h3>

        @if ($orders->isEmpty())
            <p class="text-center">Anda belum memiliki pesanan atau transaksi.</p>
        @else
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No telp</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Status Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @php
                            if ($order->status == 'success') {
                                $tr = 'table-success';
                            } elseif ($order->status == 'pending') {
                                $tr = 'table-warning';
                            } else {
                                $tr = 'table-danger';
                            }
                        @endphp
                        <tr class="{{ $tr }}">
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td><a href="{{ route('orders.show', ['id' => $order->id]) }}" class="text-dark text-decoration-none">{{ $order->name }}</a></td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        $("tr").click(function() {
            window.location.href = $(this).find("a").attr("href");
        });
    </script>
@endsection
