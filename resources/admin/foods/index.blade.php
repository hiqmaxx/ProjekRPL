@extends('layouts.app')

@section('content')
<h2>Daftar Makanan</h2>
<a href="{{ route('foods.create') }}" class="btn btn-primary mb-3">+ Tambah Makanan</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th><th>Harga</th><th>Gambar</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($foods as $food)
        <tr>
            <td>{{ $food->name }}</td>
            <td>Rp{{ number_format($food->price, 0, ',', '.') }}</td>
            <td>
                @if($food->image)
                    <img src="{{ asset('storage/' . $food->image) }}" width="100">
                @endif
            </td>
            <td>
                <a href="{{ route('foods.edit', $food->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('foods.destroy', $food->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus makanan ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
