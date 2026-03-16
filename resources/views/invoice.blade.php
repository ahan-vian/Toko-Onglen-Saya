<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pesanan #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .title { font-size: 24px; font-weight: bold; margin: 0; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { vertical-align: top; }
        .item-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .item-table th, .item-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .item-table th { background-color: #f8f9fa; }
        .text-right { text-align: right !important; }
        .text-center { text-align: center !important; }
        .total-row { font-weight: bold; background-color: #f8f9fa; }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="title">INVOICE PEMBELIAN</h1>
        <p>No. Pesanan: #{{ $order->id }} | Tanggal: {{ $order->created_at->format('d/m/Y') }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td width="50%">
                <strong>Dibayar Oleh:</strong><br>
                {{ $order->user->name }}<br>
                No. HP: {{ $order->user->phone ?? '-' }}
            </td>
            <td width="50%">
                <strong>Alamat Pengiriman:</strong><br>
                {{ $order->user->address ?? 'Belum diisi' }}
            </td>
        </tr>
    </table>

    <table class="item-table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($order->transactions as $transaction)
                @php 
                    $subtotal = $transaction->product->price * $transaction->amount;
                    $grandTotal += $subtotal;
                @endphp
                <tr>
                    <td>{{ $transaction->product->name }}</td>
                    <td class="text-center">Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $transaction->amount }}</td>
                    <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" class="text-right">TOTAL KESELURUHAN</td>
                <td class="text-right">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 50px;">
        <p><strong>Status Pembayaran:</strong> LUNAS</p>
        <p>Terima kasih telah berbelanja di toko kami!</p>
    </div>

</body>
</html>