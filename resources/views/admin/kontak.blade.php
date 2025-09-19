@extends('layouts.master_admin')

@section('title', 'Kontak Admin')

@section('content')
<div class="container mt-4">
    <h4>📝 Edit Kontak Admin</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.kontak.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="phone" value="{{ $contact->phone }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $contact->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Rekening Bank</label>
            <input type="text" name="bank_account" value="{{ $contact->bank_account }}" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan Kontak</button>
    </form>
</div>
@endsection
