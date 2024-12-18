@extends('layout')

@section('content')
    <div class="container">
        <a href="{{ route('orders.index') }}" class="text-dark-emphasis"><i class="fa-solid fa-chevron-left"></i>Kembali</a>

        <h3 class="text-center">Pesanan Anda</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <h5 class="mb-5 mt-5">Status pesanan anda {{ $order->status }}</h5>
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
                    <p>Untuk pembayaran, silakan transfer ke nomor rekening berikut : </p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Bank : Mandiri</li>
                        <li class="list-group-item">Nomor rekening : 1620005836170</li>
                        <li class="list-group-item">Atas Nama : Patricia Ranaya Pasangka</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p>Jika menggunakan dompet digital, silakan transfer ke nomor berikut : </p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">OVO : 082144946147 / AN : Elsa Seran</li>
                        <li class="list-group-item">Dana : 082144946147 / AN : Micheldis Elsa Natasha Seran</li>
                    </ul>
                </div>
            </div>
        </div>

        <div>
            @if ($isPay)
                <p class="text-success">Anda sudah upload bukti pembayaran!</p>
            @else
                <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label text-danger">Silahkan upload bukti pembayaran*</label>
                        <input class="form-control" type="file" id="formFile" name="image" accept="image/*">
                        <input type="hidden" name="order_id" value="{{ $id }}">
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            @endif

            {{-- <img id="previewImage" src="#" alt="Image Preview"> --}}
            <div id="imgPreview">

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#formFile').change(function() {
                if ($(this)[0].files.length > 0) {
                    var file = $(this)[0].files[0];

                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $("#imgPreview").append(`<img style="width: 50%;" id="previewImage" src="#" alt="Image Preview">`);
                            $('#previewImage').attr('src', e.target.result).show();
                        };

                        reader.readAsDataURL(file);
                    }
                }
            });
        });
    </script>
@endsection
