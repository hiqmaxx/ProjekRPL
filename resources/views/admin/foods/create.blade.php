@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">➕ Tambah Makanan</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('foods.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Makanan</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Contoh: Laksa Betawi" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" id="description" rows="3" placeholder="Contoh: Makanan khas Betawi dengan kuah santan gurih..."></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="Contoh: 15000" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" name="image" class="form-control" id="image" accept="image/*">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('foods.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
