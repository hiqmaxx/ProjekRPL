@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">🧾 Riwayat Pesanan Saya</h3>

    @forelse ($orders as $order)
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <span>Status: <strong>{{ ucfirst($order->status) }}</strong></span>
                <small class="text-light">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</small>
            </div>
            <div class="card-body">
                <h5 class="card-title">Detail Pesanan</h5>
                <ul class="list-group list-group-flush mb-3">
                    @foreach ($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $item->food->name }}</span>
                            <span class="badge bg-secondary rounded-pill">{{ $item->quantity }}x</span>
                        </li>
                    @endforeach
                </ul>

                <p class="mb-1">Total Harga:</p>
                <h5 class="text-success">Rp{{ number_format($order->total_price, 0, ',', '.') }}</h5>

                @if($order->qris_image)
                    <div class="mt-3">
                        <p class="mb-1">Bukti Pembayaran (QRIS):</p>
                        <img src="{{ asset('storage/' . $order->qris_image) }}" alt="Bukti QRIS" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Kamu belum pernah melakukan pesanan.
        </div>
    @endforelse
</div>
@endsection