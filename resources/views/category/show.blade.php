@extends('layouts.app')

@section('content')
<div class="category-show">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>{{ $category->name }}</h3>
            <a href="{{ route('category.index') }}" class="btn btn-secondary btn-sm">
                ← Kembali
            </a>
        </div>

        @if($products->isEmpty())
            <p class="text-muted">Belum ada produk di kategori ini</p>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-3 d-flex justify-content-center">
                        <div class="product-card-show h-100">

                            <div class="product-image-show">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}">
                                @endif
                            </div>

                            <h6 class="mt-2">{{ $product->name }}</h6>
                            <p>Rp {{ number_format($product->price) }}</p>

                            <span class="badge bg-info">
                                Stok {{ $product->stock }}
                            </span>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
