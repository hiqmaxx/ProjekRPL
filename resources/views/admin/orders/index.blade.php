@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📦 Daftar Pesanan Masuk</h2>
        <div class="btn-group">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary {{ request('type') == null ? 'active' : '' }}">
                <i class="bi bi-stack me-1"></i> Semua
            </a>
            <a href="{{ route('orders.index', ['type' => 'laksa']) }}" class="btn btn-outline-success {{ request('type') == 'laksa' ? 'active' : '' }}">
                🟢 Laksa
            </a>
            <a href="{{ route('orders.index', ['type' => 'asinan']) }}" class="btn btn-outline-warning {{ request('type') == 'asinan' ? 'active' : '' }}">
                🟠 Asinan
            </a>
            <a href="{{ route('orders.export', ['qris_type' => request('qris_type')]) }}" class="btn btn-outline-secondary">
                <i class="bi bi-download me-1"></i> Export Excel
            </a>
        </div>
    </div>

    @if(request('qris_type'))
        <p class="text-muted">Menampilkan pesanan untuk QRIS <strong>{{ ucfirst(request('qris_type')) }}</strong></p>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">Belum ada pesanan.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Customer</th>
                        <th>Makanan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal & Jam</th> {{-- Tambahan --}}
                        <th>Bukti QRIS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->food->name }} x {{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <strong>Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($order->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($order->status === 'declined')
                                    <span class="badge bg-danger">Declined</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>
                            <td>
                                @if($order->qris_image)
                                    <a href="{{ asset('storage/' . $order->qris_image) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $order->qris_image) }}" alt="QRIS" width="80" class="img-thumbnail">
                                    </a>
                                @else
                                    <em class="text-muted">Belum upload</em>
                                @endif
                            </td>
                            <td>
                                @if($order->status === 'pending')
                                    <div class="d-flex gap-2">
                                        <form method="POST" action="{{ route('orders.approve', $order->id) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-success">
                                                <i class="bi bi-check-circle me-1"></i> Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('orders.decline', $order->id) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin tolak pesanan ini?')">
                                                <i class="bi bi-x-circle me-1"></i> Decline
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
