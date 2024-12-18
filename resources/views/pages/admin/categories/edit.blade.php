@extends('admin')

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

                    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $category->name) }}">
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <label>Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusTrue"
                                            value="1" {{ old('status', $category->status) == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusTrue">True</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusFalse"
                                            value="2" {{ old('status', $category->status) == '2' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusFalse">False</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <input type="submit" class="btn" value="Update Kategori"
                                    style="background-color: #a15252; color: white; font-weight: bold;">
                                    <a class="btn btn-secondary" href="{{ route('admin.categories') }}">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
