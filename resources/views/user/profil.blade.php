@extends('layouts.master_user')

@section('title', 'Edit Profil')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">👤 Edit Profil Anda</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.profil.update') }}" method="POST" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" autocomplete="off" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" autocomplete="off" required>
        </div>
        <div class="mb-3">
            <label>Password Baru (Opsional)</label>
            <input type="password" name="password" class="form-control" autocomplete="new-password">
        </div>
        <button class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
