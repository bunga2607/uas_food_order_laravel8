<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            max-width: 700px;
            margin: 40px auto;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .info {
            margin-bottom: 25px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            background: #f9f9f9;
        }

        .info p {
            margin: 4px 0;
        }

        .info strong {
            display: inline-block;
            width: 160px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f8f8f8;
        }

        .footer {
            text-align: center;
            color: #555;
            font-style: italic;
            margin-top: 40px;
            font-size: 14px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <h2>Struk Pemesanan Makanan</h2>

    <div class="info">
        <p><strong>Nama Pelanggan:</strong> {{ $order->user->name }}</p>
        <p><strong>Tanggal Pemesanan:</strong> {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}</p>
        <p><strong>Alamat:</strong> {{ $order->address }}</p>
        <p><strong>No HP:</strong> {{ $order->phone }}</p>
        <p><strong>Metode Pembayaran:</strong> 
            {{ $order->payment_method === 'cod' ? 'Bayar di Tempat (COD)' : 'Transfer Bank' }}
        </p>
        @if($order->payment_method === 'transfer')
            <p><strong>No Rekening Tujuan:</strong> {{ $contact->bank_account }}</p>
        @endif
    </div>

    <table>
        <thead>
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
                    <td>Rp {{ number_format($item->food->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Total Pembayaran</td>
                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Terima kasih telah memesan di sistem kami. Semoga Anda puas dengan layanan kami. 😊
    </div>

</body>
</html>
