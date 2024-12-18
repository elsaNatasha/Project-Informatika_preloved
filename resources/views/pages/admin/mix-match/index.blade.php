@extends('admin')

@section('content')
    <div class="container">
        <h3 class="text-center">Buat Rekomendasi Mix & Match</h3>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="mb-5">
            <form action="{{ route('admin.mix-match.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Default select example" name="top" required>
                            <option selected disabled>Pilih atasan</option>
                            @foreach ($tops as $top)
                                <option value="{{ $top->id }}">{{ $top->productname }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Default select example" name="bottom">
                            <option selected disabled>Pilih bawahan</option>
                            @foreach ($bottoms as $bottom)
                                <option value="{{ $bottom->id }}">{{ $bottom->productname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </section>

        <section class="row row-cols-2 row-gap-3">
            @foreach ($datas as $data)
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex">
                                <div class="w-50 p-2">
                                    <img src="{{ asset('images/' . $data->top_photo) }}" alt="Image 1" width="150"
                                        height="150" style="object-fit: contain;" class="img-fluid rounded">
                                </div>
                                <div class="w-50 p-2">
                                    <img src="{{ asset('images/' . $data->bottom_photo) }}" alt="Image 2" width="150"
                                        height="150" style="object-fit: contain;" class="img-fluid rounded">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <p class="card-text">{{ $data->top_name }} : <span>{{ $data->top_desc }}</span></p>
                                    <p class="card-text">{{ $data->bottom_name }} : <span>{{ $data->bottom_desc }}</span>
                                    </p>
                                    <div>
                                        <form action="{{ route('admin.mix-match.destroy', $data->id) }}" method="POST"
                                            onsubmit="return confirm('Konfirmasi hapus?');" class="d-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ms-auto btn btn-danger">Delete</button>
                                        </form>
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
