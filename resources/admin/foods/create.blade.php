@extends('layouts.app')

@section('content')
<h2>Tambah Makanan</h2>

<form method="POST" action="{{ route('foods.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection
