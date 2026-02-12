<div class="cart-content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Keranjang</h5>
        @if(isset($isDrawer) && $isDrawer)
            <button class="btn-close" id="cartClose"></button>
        @endif
    </div>

    @if($globalOrder && $globalOrder->orderDetails->count())
        <ul class="list-group list-group-flush mb-3">
            @foreach($globalOrder->orderDetails as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                    <div class="me-auto">
                        <div class="fw-bold" style="font-size: 14px;">{{ $item->product->name }}</div>
                        <small class="text-muted">Qty: {{ $item->quantity }} x Rp {{ number_format($item->product->price) }}</small>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold" style="font-size: 14px;">Rp {{ number_format($item->product->price * $item->quantity) }}</div>
                        <form method="POST" action="{{ route('cart.remove', $item->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm text-danger p-0 border-0" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="d-flex justify-content-between align-items-center fw-bold mt-2 pt-2 border-top">
            <span>Total:</span>
            <span>Rp {{ number_format($globalOrder->orderDetails->sum(fn($i) => $i->product->price * $i->quantity)) }}</span>
        </div>

        <a href="{{ route('payment.index', $globalOrder->id) }}" class="btn btn-success w-100 mt-3 py-2 fw-bold">
            Lanjut Payment
        </a>
    @else
        <div class="text-center py-4">
            <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2">Keranjang kosong</p>
        </div>
    @endif
</div>
