@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Category</h3>
    <a href="{{ route('category.create') }}"
       class="btn btn-success rounded-pill px-4">
        + Tambah Kategori
    </a>
</div>

@if ($categories->isEmpty())
    <p class="text-muted">Belum ada kategori</p>
@else

<div class="category-view-grid">

    @foreach ($categories as $category)
        <div class="category-view-card">

            {{-- IMAGE --}}
            <div class="category-view-image">
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}"
                         alt="{{ $category->name }}"
                         class="category-view-img">
                @else
                    <div class="category-view-placeholder">
                        No Image
                    </div>
                @endif
            </div>

            {{-- BODY --}}
            <div class="category-view-body">
                <div class="category-view-title">
                    {{ $category->name }}
                </div>

                <small class="text-muted d-block mb-3">
                    ID {{ $category->id }}
                </small>
            </div>

            {{-- ACTIONS --}}
            <div class="category-view-actions mb-3">
                <a href="{{ route('category.edit', $category->id) }}"
                   class="btn btn-category-edit btn-sm">
                    Edit
                </a>

                <a href="{{ route('category.show', $category->id) }}"
                   class="btn btn-category-view btn-sm">
                    Lihat
                </a>
            </div>

        </div>
    @endforeach

</div>

@endif

@endsection
