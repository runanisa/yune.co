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
        <div class="col-lg-8">

        {{-- CATEGORY --}}
        @if($categories->count())
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">Kategori</h6>

            <div class="d-flex gap-1">
                <button id="btnLeft"
                        class="btn btn-light btn-sm category-nav"
                        onclick="scrollCategory(-1)"
                        disabled>
                    ◀
                </button>
                <button id="btnRight"
                        class="btn btn-light btn-sm category-nav"
                        onclick="scrollCategory(1)">
                    ▶
                </button>
            </div>
        </div>

        <div class="category-wrapper" id="categoryWrapper">
            <div class="d-flex gap-3 mb-4 category-scroll">
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
        </div>
        @endif


            {{-- PRODUCT --}}
            <div class="row g-2 g-md-3">
                @foreach($products as $product)
                    <div class="col-6 col-md-4 mb-3">
                        <div class="product-card h-100">
                            <div class="product-image">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}">
                                @else
                                    <div class="text-muted small">No Image</div>
                                @endif
                            </div>

                            <h6 class="mt-2 mb-1 text-truncate">{{ $product->name }}</h6>
                            <p class="mb-2">Rp {{ number_format($product->price) }}</p>

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
        <div class="col-lg-4 d-none d-lg-block">
            <div class="cart sticky-top" style="top: 20px;">
                @include('partials.cart')
            </div>
        </div>

    </div>
</div>
@endsection
