@extends('layouts.master_admin')

@section('title', 'Edit Profil Admin')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">👤 Edit Profil Admin</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.profil.update') }}" autocomplete="off">
        @csrf

        <div class="mb-3">
            <label for="name_input">Nama</label>
            <input
                type="text"
                name="name"
                id="name_input"
                class="form-control"
                placeholder="Masukkan nama"
                value=""
                autocomplete="off"
                readonly onfocus="this.removeAttribute('readonly')"
                required>
        </div>

        <div class="mb-3">
            <label for="email_input">Email</label>
            <input
                type="email"
                name="email"
                id="email_input"
                class="form-control"
                placeholder="Masukkan email"
                value=""
                autocomplete="off"
                readonly onfocus="this.removeAttribute('readonly')"
                required>
        </div>

        <div class="mb-3">
            <label for="password_input">Password Baru <small class="text-muted">(opsional)</small></label>
            <input
                type="password"
                name="password"
                id="password_input"
                class="form-control"
                placeholder="Biarkan kosong jika tidak ingin mengganti password"
                autocomplete="new-password"
                readonly onfocus="this.removeAttribute('readonly')">
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Simpan Perubahan
        </button>
    </form>
</div>
@endsection
