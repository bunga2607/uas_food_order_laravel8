@extends('layouts.master_user')

@section('title', 'Kontak Kami')

@section('content')
<div class="container mt-4">
    <h4>📞 Kontak Admin</h4>

    <div class="card p-4 shadow-sm">
        <p><strong>📱 No HP:</strong> {{ $contact->phone }}</p>
        <p><strong>📧 Email:</strong> {{ $contact->email }}</p>
        <p><strong>🏦 Rekening Bank:</strong> {{ $contact->bank_account }}</p>
    </div>
</div>
@endsection
