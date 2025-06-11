@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">🍜 Daftar Makanan</h2>
        <a href="{{ route('foods.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Tambah Makanan
        </a>
    </div>

    @if($foods->isEmpty())
        <div class="alert alert-warning">Belum ada makanan ditambahkan.</div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($foods as $food)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if($food->image)
                            <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $food->name }}">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span>Tidak ada gambar</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $food->name }}</h5>
                            <p class="card-text">
                                <span class="badge bg-success">Rp{{ number_format($food->price, 0, ',', '.') }}</span>
                            </p>

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('foods.edit', $food->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('foods.destroy', $food->id) }}" method="POST" onsubmit="return confirm('Hapus makanan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
