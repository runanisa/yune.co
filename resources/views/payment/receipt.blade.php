<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
        }
        .center {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 4px 0;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }
    </style>
</head>
<body>

    <div class="center">
        <strong>YUNE.CO</strong><br>
        ======================
    </div>

    <p>
        Tanggal : {{ $order->created_at->format('d-m-Y H:i') }} <br>
        Order #{{ $order->id }}
    </p>

    <div class="line"></div>

    <table>
        @foreach ($order->orderDetails as $item)
            <tr>
                <td colspan="2">{{ $item->product->name }}</td>
            </tr>
            <tr>
                <td>{{ $item->quantity }} x {{ number_format($item->product->price) }}</td>
                <td align="right">
                    {{ number_format($item->quantity * $item->product->price) }}
                </td>
            </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td>Total</td>
            <td align="right">Rp {{ number_format($order->total) }}</td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td align="right">Rp {{ number_format($order->paid) }}</td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td align="right">Rp {{ number_format($order->change) }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="center">
        Terima Kasih 🙏<br>
        Barang yang sudah dibeli<br>
        tidak dapat dikembalikan
    </div>

</body>
</html>
