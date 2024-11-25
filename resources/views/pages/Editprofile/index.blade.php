@extends('layoutedit')

@section('title', 'Editprofile')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="profile-card text-center">
            <div class="mb-3">
                <img src="https://via.placeholder.com/100" alt="User Avatar" class="rounded-circle">
            </div>
            <h4>{{ $user['name'] }}</h4>
            <p class="text-muted">{{ $user['email'] }}</p>
            <p class="text-muted">{{ $user['phone'] }}</p>
            <hr>
            <div class="text-start">
                <a href="#" class="d-block mb-2 text-decoration-none">Edit Profil</a>
                <a href="#" class="d-block mb-2 text-decoration-none">Pesanan Saya</a>
                <a href="#" class="d-block mb-2 text-decoration-none">Mix & Match</a>
            </div>
            <button class="logout-btn mt-4">Logout</button>
        </div>
    </div>
</div>
@endsection
