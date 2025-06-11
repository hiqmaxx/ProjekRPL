@extends('layouts.app')

@section('content')
<h2>Pesan Makanan</h2>

<form method="POST" action="{{ route('order.place') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label><strong>Pilih Makanan</strong></label>
        @foreach($foods as $food)
        <div class="border p-2 mb-2 rounded">
            <input type="checkbox" name="food_ids[]" value="{{ $food->id }}" onchange="toggleQty({{ $food->id }})">
            <strong>{{ $food->name }}</strong> - Rp{{ number_format($food->price, 0, ',', '.') }} <br>
            <small>{{ $food->description }}</small> <br>
            <input type="number" name="quantities[]" class="form-control mt-1" placeholder="Jumlah" min="1" disabled id="qty-{{ $food->id }}">
        </div>
        @endforeach
    </div>

    <div class="mb-3">
        <label>Upload Bukti QRIS</label>
        <input type="file" name="qris_image" class="form-control" required>
    </div>

    <button class="btn btn-success">Kirim Pesanan</button>
</form>

<script>
    function toggleQty(id) {
        const cb = document.querySelector(`input[value="${id}"]`);
        const qty = document.getElementById(`qty-${id}`);
        qty.disabled = !cb.checked;
    }
</script>
@endsection
