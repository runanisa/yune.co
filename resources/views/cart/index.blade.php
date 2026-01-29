@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Kasir</h3>

    @if(empty($cart))
        <p class="text-muted">Belum ada order</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $item)
                    @php $subtotal = $item['qty'] * $item['price']; @endphp
                    @php $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['qty'] }}</td>
                        <td>Rp {{ number_format($item['price']) }}</td>
                        <td>Rp {{ number_format($subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h5>Total: Rp {{ number_format($total) }}</h5>
    @endif
</div>
@endsection
