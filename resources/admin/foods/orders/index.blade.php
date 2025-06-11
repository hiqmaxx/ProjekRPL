@extends('layouts.app')

@section('content')
<h2>Daftar Pesanan</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Makanan</th>
            <th>Total</th>
            <th>Status</th>
            <th>Bukti QRIS</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->user->name }}</td>
            <td>
                <ul>
                    @foreach ($order->items as $item)
                        <li>{{ $item->food->name }} x {{ $item->quantity }}</li>
                    @endforeach
                </ul>
            </td>
            <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>
                @if($order->qris_image)
                    <img src="{{ asset('storage/' . $order->qris_image) }}" width="100">
                @endif
            </td>
            <td>
                @if($order->status == 'pending')
                <form method="POST" action="{{ route('orders.approve', $order->id) }}">
                    @csrf
                    <button class="btn btn-sm btn-success">Approve</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
