@extends('layoutprofile')

@section('title', 'Profil Penjual')

@section('content')
<div class="card p-4">
    <!-- Header Profil -->
    <div class="d-flex align-items-center mb-4">
        <img src="{{ asset('storage/' . ($user->avatar ?? 'default-avatar.png')) }}" alt="Avatar" class="rounded-circle" width="80" height="80">
        <div class="ms-3">
            <h4 class="mb-1">{Callista}</h4>
            <p class="mb-0 text-muted">{Calissta01@gmail.com}</p>
            <p class="mb-0 text-muted">{+62 948393773}</p>
        </div>
        <a href="{{ route('profile.edit') }}" class="ms-auto text-decoration-none text-muted">
            <i class="bi bi-pencil-square fs-4"></i>
        </a>
    </div>

    <!-- Menu -->
    <div class="list-group">
        <a href="{{ route('profile.edit') }}" class="list-group-item d-flex align-items-center">
            <i class="bi bi-person-circle fs-4 me-3"></i> Edit Profil
        </a>
        <a href="{{ route('financial.report') }}" class="list-group-item d-flex align-items-center">
            <i class="bi bi-wallet2 fs-4 me-3"></i> Laporan Keuangan
        </a>
        <a href="{{ route('product.create') }}" class="list-group-item d-flex align-items-center">
            <i class="bi bi-plus-circle fs-4 me-3"></i> Tambah Produk
        </a>
    </div>

    <!-- Logout -->
    <div class="text-center mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-dark px-4">Logout</button>
        </form>
    </div>
</div>
@endsection
