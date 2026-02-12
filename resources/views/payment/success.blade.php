@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0" style="max-width: 500px; width: 100%; border-radius: 20px;">
        <div class="card-body p-4 text-center">
            <div class="mb-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                <h3 class="mt-3 fw-bold">Pembayaran Berhasil!</h3>
                <p class="text-muted">Order #{{ $order->id }} - {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-sm text-start">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $item)
                        <tr>
                            <td>
                                {{ $item->product->name }}<br>
                                <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->product->price) }}</small>
                            </td>
                            <td class="text-end align-middle">
                                Rp {{ number_format($item->quantity * $item->product->price) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-light p-3 rounded-4 text-start mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Belanja</span>
                    <span class="fw-bold">Rp {{ number_format($order->total) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Uang Bayar</span>
                    <span class="fw-bold text-success">Rp {{ number_format($order->paid) }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Kembalian</span>
                    <span class="fw-bold text-primary">Rp {{ number_format($order->change) }}</span>
                </div>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('payment.receipt', $order->id) }}" id="printBtn" class="btn btn-primary py-2 fw-bold rounded-3">
                    <i class="bi bi-printer me-2"></i>Cetak Struk (PDF)
                </a>
                <a href="{{ route('overview') }}" class="btn btn-outline-secondary py-2 fw-bold rounded-3">
                    Kembali ke Awal
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('printBtn').addEventListener('click', function(e) {
        // Jangan biar link normal jalan dulu
        e.preventDefault();
        
        // Buka struk di tab baru (PDF Download)
        window.open(this.href, '_blank');
        
        // Langsung arahkan halaman ini balik ke awal sesuai permintaan
        setTimeout(() => {
            window.location.href = "{{ route('overview') }}";
        }, 500);
    });
</script>
@endsection
