@extends('layouts.app')

@section('content')

{{-- 🔥 POP UP STOK HABIS --}}
@if(session('stock_error'))
<div class="modal fade" id="stockModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content stock-modal">
            <div class="modal-header">
                <h5 class="modal-title">Stok Habis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{ session('stock_error') }}
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary w-100" data-bs-dismiss="modal">
                    Oke
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        new bootstrap.Modal(
            document.getElementById('stockModal')
        ).show();
    });
</script>
@endif


<div class="container">
    <div class="row">

        {{-- ================= PRODUK ================= --}}
        <div class="col-md-8">

            {{-- CATEGORY --}}
            @if($categories->count())
                <div class="d-flex gap-3 mb-4 overflow-auto">
                    <a href="/" class="category-card {{ !$categoryId ? 'active' : '' }}">
                        <p>Semua</p>
                    </a>

                    @foreach($categories as $category)
                        <a href="/?category={{ $category->id }}"
                           class="category-card {{ $categoryId == $category->id ? 'active' : '' }}">
                            @if($category->image)
                                <img src="{{ asset('storage/'.$category->image) }}">
                            @endif
                            <p>{{ $category->name }}</p>
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- PRODUCT --}}
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="product-card h-100">

                            <div class="product-image">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}">
                                @else
                                    <div>No Image</div>
                                @endif
                            </div>

                            <h6 class="mt-2">{{ $product->name }}</h6>
                            <p>Rp {{ number_format($product->price) }}</p>

                            <a href="{{ route('cart.add', $product->id) }}"
                               class="btn btn-primary btn-sm w-100">
                                Order
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- ================= KERANJANG ================= --}}
        <div class="col-md-4">
            <div class="cart">

                <h5>Keranjang</h5>

                @if($order && $order->orderDetails->count())
                    <ul class="list-group">
                        @foreach($order->orderDetails as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    {{ $item->product->name }}
                                    <small>x {{ $item->quantity }}</small>
                                </div>

                                <div class="d-flex gap-2">
                                    <span>
                                        Rp {{ number_format($item->product->price * $item->quantity) }}
                                    </span>

                                    <form method="POST"
                                          action="{{ route('cart.remove', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">✕</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <p class="fw-bold mt-2">
                        Total:
                        Rp {{ number_format(
                            $order->orderDetails->sum(fn($i) =>
                                $i->product->price * $i->quantity
                            )
                        ) }}
                    </p>

                    <a href="{{ route('payment.index', $order->id) }}"
                       class="btn btn-success w-100">
                        Lanjut Payment
                    </a>
                @else
                    <p class="text-muted">Keranjang kosong</p>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
