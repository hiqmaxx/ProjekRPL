@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">✏️ Edit Makanan</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('foods.update', $food->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Makanan</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $food->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ $food->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ $food->price }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @if($food->image)
                        <img src="{{ asset('storage/' . $food->image) }}" width="120" class="mt-2 rounded shadow-sm" alt="Gambar Makanan">
                    @endif
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('foods.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
