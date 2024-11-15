@extends('layout')

@section('content')
<div class="container">
    <h3 align="center">Category</h3>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="form-area">
                <!-- Tampilkan pesan error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('category.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="statusTrue" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusTrue">True</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="statusFalse" value="2" {{ old('status') == '2' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusFalse">False</label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-primary" value="Tambahkan">
                        </div>
                    </div>
                </form>
            </div>

            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td scope="col">{{ ++$key }}</td>
                            <td scope="col">{{ $category->name }}</td>
                            <td scope="col">
                                @if ($category->status == 1)
                                    true 
                                @else
                                    false
                                @endif
                            </td>
                            <td scope="col">
                                <a href="{{ route('category.edit', $category->id) }}">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
                                    </button>
                                </a>

                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('css')
    <style>
        .form-area {
            padding: 20px;
            margin-top: 20px;
            background-color: white;
        }
    </style>
@endpush
