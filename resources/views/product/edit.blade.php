@extends('layouts.app')

@section('content')
<div class="container">
<h3>Edit Product</h3>

<form action="{{ route('product.update', $product->id) }}"
      method="POST"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control"
           value="{{ $product->name }}" required>
</div>

<div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" class="form-control" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Harga</label>
    <input type="number" name="price" class="form-control"
           value="{{ $product->price }}" required>
</div>

<div class="mb-3">
    <label>Stock</label>
    <input type="number" name="stock" min="0"
           class="form-control"
           value="{{ $product->stock }}" required>
</div>

<div class="mb-3">
    <label>Gambar</label><br>

    @if ($product->image)
        <img src="{{ asset('storage/'.$product->image) }}"
             width="100" class="mb-2">
    @endif

    <input type="file" name="image" class="form-control">
</div>

<button class="btn btn-primary">Update</button>
<a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
</form>
</div>
@endsection
