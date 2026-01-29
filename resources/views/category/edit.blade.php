@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Kategori</h3>

    <form action="{{ route('category.update', $category->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="name"
                   class="form-control"
                   value="{{ $category->name }}">
        </div>

        @if ($category->image)
            <div class="mb-3">
                <img src="{{ asset('storage/'.$category->image) }}"
                     style="max-height:100px">
            </div>
        @endif

        <div class="mb-3">
            <label>Foto (opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">
            Batal
        </a>
    </form>
</div>
@endsection
