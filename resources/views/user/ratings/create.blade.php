@extends('layouts.master_user')

@section('title', 'Beri Rating')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">✨ Beri Rating & Ulasan</h4>

    <form action="{{ route('user.ratings.store', $order->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="rating">Rating (1-5)</label>
            <select name="rating" id="rating" class="form-select" required>
                <option value="">Pilih Rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="comment">Komentar</label>
            <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Tulis ulasan Anda..." required></textarea>
        </div>

        <button class="btn btn-success">Kirim Ulasan</button>
    </form>
</div>
@endsection
