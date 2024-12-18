@extends('layout')
@section('content')
    <div class="container">
        <h3 class="text-center">Rekomendasi Kami</h3>

        <section class="row row-cols-2 row-gap-3">
            @foreach ($datas as $data)
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex">
                                <div class="w-50 p-2">
                                    <img src="{{ asset('images/'.$data->top_photo) }}" alt="Image 1" width="150"
                                        height="150" style="object-fit: contain;" class="img-fluid rounded">
                                </div>
                                <div class="w-50 p-2">
                                    <img src="{{ asset('images/'.$data->bottom_photo) }}" alt="Image 2" width="150"
                                        height="150" style="object-fit: contain;" class="img-fluid rounded">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <p class="card-text">{{ $data->top_name }} : <span>{{ $data->top_desc }}</span></p>
                                    <p class="card-text">{{ $data->bottom_name }} : <span>{{ $data->bottom_desc }}</span></p>
                                    <div class="d-flex">
                                        {{-- <button class="ms-auto btn btn-light"><i class="fa-regular fa-heart"></i></button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </section>
    </div>
@endsection

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html> --}}
