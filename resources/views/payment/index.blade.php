@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Payment</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($order->orderDetails as $item)
                    @php
                        $subtotal = $item->quantity * $item->product->price;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->product->price) }}</td>
                        <td>Rp {{ number_format($subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h5>Total: <strong>Rp {{ number_format($total) }}</strong></h5>

    <form id="paymentForm" action="{{ route('payment.pay', $order->id) }}" method="POST">
    @csrf
        <div class="mb-3">
            <label>Uang Bayar</label>
            <input type="number" name="paid" id="paid" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kembalian</label>
            <input type="text" id="change" class="form-control" value="Rp 0" readonly>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('overview') }}" class="btn btn-secondary w-50">
                Batal
            </a>

            <button type="submit" id="payBtn" class="btn btn-success" disabled>
                Bayar
            </button>
        </div>
    </form>
</div>

<script>
    const total = {{ $total }};
    const paidInput = document.getElementById('paid');
    const changeInput = document.getElementById('change');
    const payBtn = document.getElementById('payBtn');

    paidInput.addEventListener('input', () => {
        const paid = parseInt(paidInput.value) || 0;
        const change = paid - total;

        if (change >= 0) {
            changeInput.value = 'Rp ' + change.toLocaleString('id-ID');
            payBtn.disabled = false;
        } else {
            changeInput.value = 'Rp 0';
            payBtn.disabled = true;
        }
    });
</script>
@endsection
