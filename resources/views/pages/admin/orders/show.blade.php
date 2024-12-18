@extends('admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.orders') }}" class="text-dark-emphasis"><i class="fa-solid fa-chevron-left"></i>Kembali</a>

        <h3 class="text-center">Pesanan Anda</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <h5 class="mb-3 mt-5">Detail pesanan</h5>
            @if ($order->status == 'pending')
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="mb-5 btn btn-success">Konfirmasi</button>
                </form>
            @endif
            <ol class="list-group-numbered">
                @php
                    $totalHarga = 0;
                @endphp
                @foreach ($products as $prod)
                    @php
                        $totalHarga += (int) $prod->price;
                    @endphp
                    <li class="list-group-item">{{ $prod->productname }} : Rp {{ number_format($prod->price) }}</li>
                @endforeach
            </ol>
            <p>Total Harga : <span class="fw-bold">Rp {{ number_format($totalHarga) }}</span></p>
        </div>

        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama : {{ $order->name }}</li>
                        <li class="list-group-item">No telp : {{ $order->phone }}</li>
                        <li class="list-group-item">Alamat : {{ $order->address }}</li>
                        <li class="list-group-item">Status : {{ $order->status }}</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <img style="width: 75%" src="{{ asset('payments/'.$transaction->payment_proof) }}" alt="">
                </div>
            </div>
        </div>

        <div>
            <div id="imgPreview">

            </div>
        </div>
    </div>
@endsection
