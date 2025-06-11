@extends('layouts.app')

@section('content')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #f9a825, #ff7043);
        color: white;
        padding: 40px 20px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 30px;
        text-align: center;
        transition: transform 0.3s ease;
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0; /* start hidden for animation */
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .stat-card p {
        font-weight: bold;
        color: #555;
    }

    .table-section {
        background: #fffde7;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        animation: fadeInUp 1s ease forwards;
        opacity: 0; /* start hidden for animation */
        animation-delay: 0.8s;
    }

    .table-section h4 {
        font-weight: bold;
        margin-bottom: 20px;
    }

    .btn-group {
        margin-bottom: 30px;
        animation: fadeInUp 1.2s ease forwards;
        opacity: 0; /* start hidden for animation */
        animation-delay: 1s;
    }

    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Delay bertahap untuk stat-card */
    .stat-card:nth-child(1) {
      animation-delay: 0.2s;
    }
    .stat-card:nth-child(2) {
      animation-delay: 0.4s;
    }
    .stat-card:nth-child(3) {
      animation-delay: 0.6s;
    }
</style>

<div class="dashboard-header text-center">
    <h2 class="fw-bold">Dashboard Admin</h2>
    <p>Kelola makanan, pesanan, dan pengguna dengan mudah</p>
</div>

<div class="container">

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <h1>{{ $foodCount }}</h1>
                <p>Total Makanan</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <h1>{{ $userCount }}</h1>
                <p>Total Pengguna</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <h1>{{ $orderCount }}</h1>
                <p>Total Pesanan</p>
            </div>
        </div>
    </div>

    <div class="btn-group">
        <a href="{{ route('foods.index') }}" class="btn btn-outline-primary">Kelola Makanan</a>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-success">Lihat Pesanan</a>
    </div>

    <div class="table-section">
        <h4>Makanan Terbaru</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentFoods as $food)
                    <tr>
                        <td>{{ $food->name }}</td>
                        <td>Rp{{ number_format($food->price, 0, ',', '.') }}</td>
                        <td>{{ $food->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-section">
        <h4>Pesanan Terbaru</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentOrders as $order)
                    <tr>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td><strong>Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
