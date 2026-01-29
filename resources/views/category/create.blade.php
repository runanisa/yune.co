@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Kategori</h3>

    <form action="{{ route('category.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Foto Kategori</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
