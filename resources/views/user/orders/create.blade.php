@extends('layouts.master_user')

@section('title', 'Pesan Makanan')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">🍽️ Form Pemesanan Makanan</h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('user.order.store') }}" method="POST" autocomplete="off">
        @csrf

        <div class="mb-3">
            <label for="address" class="form-label">Alamat Lengkap</label>
            <textarea name="address" class="form-control" rows="2" required>{{ old('address') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">No HP Aktif</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Catatan Tambahan (Opsional)</label>
            <textarea name="note" class="form-control" rows="2">{{ old('note') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select name="payment_method" class="form-select" required>
                <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Bayar di Tempat (COD)</option>
                <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
            </select>
        </div>

        <h5 class="mb-3">🧾 Daftar Menu Makanan</h5>

        @foreach($foods as $food)
        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">{{ $food->name }} (Rp {{ number_format($food->price, 0, ',', '.') }})</h6>
                    <small class="text-muted">{{ $food->description }}</small>
                </div>
                <div>
                    <input type="hidden" name="foods[{{ $loop->index }}][id]" value="{{ $food->id }}">
                    <label class="form-label mb-0">Jumlah</label>
                    <input type="number" name="foods[{{ $loop->index }}][qty]" value="0" min="0" class="form-control" style="width: 80px;">
                </div>
            </div>
        </div>
        @endforeach

        <div class="mt-4 text-end">
            <button class="btn btn-success">
                <i class="bi bi-check-circle"></i> Kirim Pesanan
            </button>
        </div>
    </form>
</div>
@endsection
