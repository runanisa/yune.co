@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">History Order</h3>

    @if($orders->isEmpty())
        <p class="text-muted">Belum ada transaksi.</p>
    @else
        @foreach($orders as $order)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <strong>Order #{{ $order->id }}</strong>
                    <span class="text-muted">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </span>
                </div>

                <div class="card-body p-0">
                    <table class="table mb-0">
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

                <div class="card-footer text-end fw-bold">
                    Total: Rp {{ number_format($total) }}
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
