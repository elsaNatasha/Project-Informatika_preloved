{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preloved</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body> --}}

@extends('layout')
@section('content')
    {{-- <nav class="navbar navbar-expand-lg" style="background-color: #bea2a2">
            <div class="container-fluid container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-cart-plus"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-circle-user"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> --}}

    <div class="container">
        <a href="/" class="text-dark-emphasis"><i class="fa-solid fa-chevron-left"></i> Mix & Match</a>

        <div class="row overflow-x-auto flex-nowrap mt-5">
            @foreach ($products as $product)
                <div class="col-3 card-group">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('images/' . $product->photo) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->productname }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Rp. {{ number_format($product->price) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border border-0">
                            <div class="d-flex">
                                <button class="ms-auto btn btn-light"><i class="fa-regular fa-heart"></i></button>
                                <button class="btn btn-light"><i class="fa-solid fa-cart-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <section class="d-flex justify-content-center align-items-center flex-column mt-5">
            <div class="d-flex flex-column">
                <!-- Button trigger modal top -->
                <button type="button" class="btn" style="background-color: #bea2a2;color: white" data-bs-toggle="modal" data-bs-target="#top">
                    Pilih atasan
                </button>
    
                {{-- Figure atasan --}}
                <figure class="figure">
                    <img id="image-preview-top" src="{{ asset('images/default-thumbnail.png') }}" class="figure-img rounded" alt="..."
                        style="width: 300px;height: 400px;object-fit: contain;">
                    <figcaption class="figure-caption">Atasan</figcaption>
                </figure>
            </div>
    
            <div class="d-flex flex-column" style="margin-top: -2rem">
                {{-- Figure bawahan --}}
                <figure class="figure border border-0">
                    <img id="image-preview-bottom" src="{{ asset('images/default-thumbnail.png') }}" class="figure-img rounded" alt="..."
                    style="width: 300px;height: 400px;object-fit: contain;">
                    <figcaption class="figure-caption">Bawahan</figcaption>
                </figure>

                {{-- Button modal bottom --}}
                <button type="button" class="btn" style="background-color: #bea2a2;color: white" data-bs-toggle="modal" data-bs-target="#bottom">
                    Pilih bawahan
                </button>
            </div>
        </section>
    </div>

    <!-- Modal Top -->
    <div class="modal fade" id="top" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Atasan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-4">
                        @foreach ($tops as $top)
                            <div class="col mt-2">
                                <input type="radio" class="btn-check" name="top" id="image1-{{ $loop->index }}"
                                    autocomplete="off" value="{{ $top->photo }}">
                                <label class="btn btn-outline-danger" for="image1-{{ $loop->index }}">
                                    <img class="img-thumbnail" src="{{ asset('images/' . $top->photo) }}" alt="">
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD

    <!-- Modal Bottom -->
    <div class="modal fade" id="bottom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Bawahan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-4">
                        @foreach ($bottoms as $bottom)
                            <div class="col mt-2">
                                <input type="radio" class="btn-check" name="bottom" id="image2-{{ $loop->index }}"
                                    autocomplete="off" value="{{ $bottom->photo }}">
                                <label class="btn btn-outline-danger" for="image2-{{ $loop->index }}">
                                    <img class="img-thumbnail" src="{{ asset('images/' . $bottom->photo) }}"
                                        alt="">
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            // Top / atasan
            $('input[type="radio"][name="top"]').on('change', function() {
                const imageUrl = 'images/' + $(this).val();
                if (imageUrl) {
                    $('#image-preview-top').attr('src', imageUrl).show();
                }
            });

            // Bottom / bawahan
            $('input[type="radio"][name="bottom"]').on('change', function() {
                const imageUrl = 'images/' + $(this).val();
                if (imageUrl) {
                    $('#image-preview-bottom').attr('src', imageUrl).show();
                }
            });
        });
    </script>
@endsection

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html> --}}
=======
</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 30c883e1d38cb5e34102c50432571f7e40d86355
>>>>>>> a3666f4a9ea0ebd6f501f5d870cb230b961aaad7
