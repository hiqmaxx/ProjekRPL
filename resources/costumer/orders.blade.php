@extends('layouts.app')

@section('content')
<h2>Pesanan Saya</h2>

@foreach ($orders as $order)
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Status: {{ ucfirst($order->status) }}</h5>
        <p class="card-text">
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->food->name }} x {{ $item->quantity }}</li>
                @endforeach
            </ul>
            Total: <strong>Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong>
        </p>
        <p>Bukti QRIS:</p>
        @if($order->qris_image)
            <img src="{{ asset('storage/' . $order->qris_image) }}" width="150">
        @endif
    </div>
</div>
@endforeach
@endsection
    