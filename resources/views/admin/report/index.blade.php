@extends('layouts.master_admin')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">📊 Laporan Penjualan</h4>

    <div class="mb-3 text-end">
        <a href="{{ route('admin.report.pdf') }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>

    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Nama User</th>
                    <th>Tanggal Pesan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge bg-success">Selesai</span></td>
                    </tr>
                    @php $total += $order->total_price; @endphp
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada data penjualan.</td>
                    </tr>
                @endforelse
            </tbody>
            @if ($orders->count())
            <tfoot class="table-light fw-bold">
                <tr>
                    <td colspan="2">Total Penjualan</td>
                    <td colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection
