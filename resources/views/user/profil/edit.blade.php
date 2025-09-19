@extends('layouts.master_user')

@section('title', 'Edit Profil')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">👤 Edit Profil</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.profil.update') }}" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Baru" autocomplete="off" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email Baru" autocomplete="off" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru <small class="text-muted">(Opsional)</small></label>
            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Perubahan</button>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </form>
</div>
@endsection
