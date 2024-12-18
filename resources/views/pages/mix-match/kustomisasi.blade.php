@extends('layout')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('mix-match.index') }}" class="text-dark-emphasis"><i class="fa-solid fa-chevron-left"></i> Mix & Match</a>

        <div class="row overflow-x-auto flex-nowrap w-100 mt-5">
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
                                @if ($product->isFavorite)
                                    <a href="{{ route('favorites.index') }}" type="button"
                                        class="btn btn-danger btn-sm mx-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Barang sudah ditambahkan ke favorite">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                @else
                                    <form action="{{ route('favorites.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button class="btn btn-outline-secondary btn-sm mx-1">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </form>
                                @endif

                                @if ($product->isAddedCart)
                                    <a href="{{ route('carts.index') }}" type="button" class="btn btn-primary btn-sm mx-1"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Barang sudah ditambahkan ke keranjang">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                @else
                                    <form action="{{ route('carts.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button class="btn btn-outline-primary btn-sm mx-1 add-to-cart"
                                            data-product-id="{{ $product->id }}">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                @endif
                                {{-- <button class="ms-auto btn btn-light"><i class="fa-regular fa-heart"></i></button>
                                <button class="btn btn-light"><i class="fa-solid fa-cart-plus"></i></button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <section class="d-flex justify-content-center align-items-center flex-column mt-5">
            <div class="d-flex flex-column">
                <!-- Button trigger modal top -->
                <button type="button" class="btn" style="background-color: #bea2a2;color: white" data-bs-toggle="modal"
                    data-bs-target="#top">
                    Pilih atasan
                </button>

                {{-- Figure atasan --}}
                <figure class="figure">
                    <img id="image-preview-top" src="{{ asset('images/default-thumbnail.png') }}"
                        class="figure-img rounded" alt="..." style="width: 300px;height: 400px;object-fit: contain;">
                    <figcaption class="figure-caption">Atasan</figcaption>
                </figure>
            </div>

            <div class="d-flex flex-column" style="margin-top: -2rem">
                {{-- Figure bawahan --}}
                <figure class="figure border border-0">
                    <img id="image-preview-bottom" src="{{ asset('images/default-thumbnail.png') }}"
                        class="figure-img rounded" alt="..." style="width: 300px;height: 400px;object-fit: contain;">
                    <figcaption class="figure-caption">Bawahan</figcaption>
                </figure>

                {{-- Button modal bottom --}}
                <button type="button" class="btn" style="background-color: #bea2a2;color: white" data-bs-toggle="modal"
                    data-bs-target="#bottom">
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

    <script>
        $(document).ready(function() {
            // Top / atasan
            const domain = window.location.protocol + "//" + window.location.host + "/";
            $('input[type="radio"][name="top"]').on('change', function() {
                const imageUrl = 'images/' + $(this).val();
                if (imageUrl) {
                    $('#image-preview-top').attr('src', domain + imageUrl).show();
                }
            });

            // Bottom / bawahan
            $('input[type="radio"][name="bottom"]').on('change', function() {
                const imageUrl = 'images/' + $(this).val();
                if (imageUrl) {
                    $('#image-preview-bottom').attr('src', domain + imageUrl).show();
                }
            });
        });
    </script>
@endsection
