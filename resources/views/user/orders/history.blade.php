@extends('layouts.master_user')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">🕓 Riwayat Pesanan Anda</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($orders as $order)
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between flex-wrap">
                <div>
                    <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}
                </div>
                <div>
                    <strong>Status:</strong>
                    <span class="badge 
                        @if($order->status == 'pending') bg-secondary
                        @elseif($order->status == 'proses') bg-warning text-dark
                        @else bg-success @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div>
                    <strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Nama Makanan</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->food->name }}</td>
                                <td class="text-end">Rp {{ number_format($item->food->price, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-light fw-bold">
                                <td colspan="3" class="text-end">Total Pembayaran</td>
                                <td class="text-end">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex flex-wrap gap-2">
                    {{-- Cetak Struk --}}
                    <a href="{{ route('user.orders.print', $order->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-printer"></i> Cetak Struk
                    </a>

                    {{-- Batal jika masih pending --}}
                    @if($order->status === 'pending')
                        <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Batalkan pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-x-circle"></i> Batal
                            </button>
                        </form>
                    @endif

                    {{-- Hapus jika selesai --}}
                    @if($order->status === 'selesai')
                        <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    @endif

                    {{-- Beri Rating jika belum pernah kasih --}}
                    @if($order->status === 'selesai' && !$order->rating)
                        <a href="{{ route('user.ratings.create', $order->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-star"></i> Beri Rating
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada pesanan.</div>
    @endforelse
</div>
@endsection
