@extends('layouts.master_admin')

@section('title', 'Ulasan & Rating Makanan')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">✨ Ulasan & Rating dari Pengguna</h4>

    @if ($ratings->isEmpty())
        <div class="alert alert-info">Belum ada ulasan dari user.</div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>👤 User</th>
                        <th>📦 Order ID</th>
                        <th>⭐ Rating</th>
                        <th>💬 Komentar</th>
                        <th>📅 Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ratings as $rating)
                        <tr>
                            <td>{{ $rating->user->name }}</td>
                            <td>#{{ $rating->order_id }}</td>
                            <td>{{ $rating->rating }} / 5</td>
                            <td>{{ $rating->comment }}</td>
                            <td>{{ $rating->created_at->translatedFormat('d F Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
