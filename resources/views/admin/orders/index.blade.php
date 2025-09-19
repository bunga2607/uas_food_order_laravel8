@extends('layouts.master_admin')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">📦 Kelola Pesanan Masuk</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>👤 User</th>
                    <th>📅 Tanggal</th>
                    <th>💰 Total</th>
                    <th>📦 Status</th>
                    <th class="text-nowrap">⚙️ Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>
                        @if ($order->status === 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <select name="status" class="form-select form-select-sm text-capitalize" onchange="this.form.submit()">
                                    @if ($order->status === 'pending')
                                        <option value="pending" selected>Pending</option>
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                    @elseif ($order->status === 'proses')
                                        <option value="proses" selected>Proses</option>
                                        <option value="selesai">Selesai</option>
                                    @endif
                                </select>
                            </form>
                        @endif
                    </td>
                    <td class="text-center">
                        <!-- Tombol Detail -->
                        <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#detailModal{{ $order->id }}">
                            <i class="bi bi-eye"></i> Detail
                        </button>

                        @if($order->status !== 'selesai')
                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada pesanan yang masuk.</td>
                </tr>
                @endforelse
            </tbody>

            @if($orders->count())
            <tfoot>
                <tr class="fw-bold table-light">
                    <td colspan="2">Total Semua Pesanan</td>
                    <td colspan="3">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

<!-- MODAL DETAIL -->
@foreach ($orders as $order)
<div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailModalLabel{{ $order->id }}">🧾 Rincian Pesanan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <p><strong>👤 Nama:</strong> {{ $order->user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>📅 Tanggal:</strong> {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y H:i') }}</p>
                    </div>
                </div>

                <h6 class="fw-bold mb-2 mt-3">🍱 Makanan Dipesan:</h6>
                <table class="table table-bordered table-sm">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Nama Makanan</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->food->name }}</td>
                            <td class="text-end">Rp {{ number_format($item->food->price, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total Bayar</td>
                            <td class="fw-bold text-end">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

                <hr>
                <p><strong>💳 Metode Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>📍 Alamat:</strong> {{ $order->address }}</p>
                <p><strong>📱 No HP:</strong> {{ $order->phone }}</p>
                @if ($order->note)
                <p><strong>📝 Catatan:</strong> {{ $order->note }}</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
