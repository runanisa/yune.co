@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Product</h3>
    <a href="{{ route('product.create') }}"
       class="btn btn-success rounded-pill px-4">
        + Tambah Product
    </a>
</div>

@if ($products->isEmpty())
    <p class="text-muted">Belum ada product</p>
@else

<div class="product-view-grid">

@foreach ($products as $product)
    <div class="product-view-card">

        {{-- IMAGE --}}
        <div class="product-view-image">
            @if ($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="product-view-img">
            @else
                <div class="product-view-placeholder">
                    No Image
                </div>
            @endif
        </div>

        {{-- BODY --}}
        <div class="product-view-body">
            <div class="product-view-title">
                {{ $product->name }}
            </div>

            <small class="text-muted d-block mb-1">
                {{ $product->category->name ?? '-' }}
            </small>

            <div class="product-view-price">
                Rp {{ number_format($product->price) }}
            </div>

            @if ($product->stock == 0)
                <span class="badge bg-danger">Habis</span>
            @else
                <span class="badge bg-success">
                    Stok {{ $product->stock }}
                </span>
            @endif
        </div>

        {{-- ACTION --}}
        <div class="product-view-actions mt-2">
            <a href="{{ route('product.edit', $product->id) }}"
               class="btn btn-product-edit btn-sm">
                Edit
            </a>
        </div>

    </div>
@endforeach

</div>
@endif

@endsection
