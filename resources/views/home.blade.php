@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f5f5f5;
        font-family: 'Segoe UI', sans-serif;
    }

    .dashboard-card {
        max-width: 600px;
        margin: auto;
        margin-top: 8vh;
        background: white;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #43a047, #2e7d32);
        padding: 30px;
        color: white;
        text-align: center;
    }

    .dashboard-header h2 {
        margin: 0;
        font-weight: bold;
    }

    .dashboard-body {
        padding: 40px 30px;
        text-align: center;
    }

    .dashboard-body p {
        font-size: 18px;
        margin-bottom: 24px;
        color: #444;
    }

    .btn-welcome {
        background: #43a047;
        color: white;
        border: none;
        padding: 12px 24px;
        font-size: 16px;
        border-radius: 8px;
        transition: background 0.3s ease;
        font-weight: bold;
    }

    .btn-welcome:hover {
        background: #2e7d32;
    }
</style>

<div class="dashboard-card">
    <div class="dashboard-header">
        <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
    </div>

    <div class="dashboard-body">
        @if (session('status'))
            <div class="alert alert-success mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <p>Kamu telah berhasil login. Silakan mulai memesan makanan favoritmu sekarang.</p>
        <a href="{{ url('/') }}">
            <button class="btn-welcome">🍜 Pesan Sekarang</button>
        </a>
    </div>
</div>
@endsection
