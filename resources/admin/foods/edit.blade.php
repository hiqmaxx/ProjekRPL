@extends('layouts.app')

@section('content')
<h2>Edit Makanan</h2>

<form method="POST" action="{{ route('foods.update', $food->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $food->name }}" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control">{{ $food->description }}</textarea>
    </div>
    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="price" class="form-control" value="{{ $food->price }}" required>
    </div>
    <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="image" class="form-control">
        @if($food->image)
            <img src="{{ asset('storage/' . $food->image) }}" width="100" class="mt-2">
        @endif
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
