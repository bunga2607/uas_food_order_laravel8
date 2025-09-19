@extends('layouts.master_user')

@section('title', 'Pesan Makanan')

@section('content')
<div class="container mt-4">
    <h4>Form Pemesanan Makanan</h4>
    <form action="{{ route('user.order.store') }}" method="POST">
        @csrf

        @foreach($foods as $food)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5>{{ $food->name }} (Rp {{ number_format($food->price, 0, ',', '.') }})</h5>
                    <p>{{ $food->description }}</p>
                </div>
                <div>
                    <input type="hidden" name="foods[{{ $loop->index }}][id]" value="{{ $food->id }}">
                    <label>Jumlah:</label>
                    <input type="number" name="foods[{{ $loop->index }}][qty]" value="0" min="0" class="form-control" style="width: 80px;">
                </div>
            </div>
        </div>
        @endforeach

        <button class="btn btn-primary">Kirim Pesanan</button>
    </form>
</div>
@endsection
