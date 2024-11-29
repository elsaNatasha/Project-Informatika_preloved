@extends('layout')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h3 align="center">Edit Category</h3>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="form-area">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('category.update', $category->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}">
                        </div>

                        <div class="col-md-6">
                            <label>Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusTrue" value="1" 
                                    {{ old('status', $category->status) == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusTrue">True</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusFalse" value="2" 
                                    {{ old('status', $category->status) == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusFalse">False</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn" value="Update" style="background-color: #a15252; color: white; font-weight: bold;">
                            <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 30c883e1d38cb5e34102c50432571f7e40d86355
