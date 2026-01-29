@extends('layouts.app')

@section('content')
<div class="container">
<h3>Tambah Product</h3>

<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="mb-3">
    <label>Nama Product</label>
    <input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Harga</label>
    <input type="number" name="price" class="form-control" required>
</div>

<div class="mb-3">
    <label>Stock</label>
    <input type="number" name="stock" min="0" class="form-control" required>
</div>

<div class="mb-3">
    <label>Foto Product</label>
    <input type="file" name="image" class="form-control">
</div>

<button class="btn btn-primary">Simpan</button>
<a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
</form>
</div>
@endsection
