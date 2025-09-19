<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan</h2>
    <p>Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>User</th>
                <th>Makanan</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $item->food->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
