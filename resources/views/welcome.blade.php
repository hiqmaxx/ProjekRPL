@extends('layouts.app')

@section('content')

<style>
    .hero {
        position: relative;
        background: linear-gradient(to right, #ffecb3, #ffe0b2);
        border-radius: 12px;
        padding: 60px 30px;
        min-height: 300px;
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url('{{ asset('storage/laksa.png') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.2;
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        color: #4e342e;
    }

    .promo-text {
        background-color: #ffe082;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: bold;
        color: #4e342e;
        display: inline-block;
    }

    .menu-title {
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .menu-wrapper {
        display: flex;
        justify-content: center;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
        max-width: 900px;
        width: 100%;
    }

    .menu-item {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        transition: transform 0.2s ease;
        cursor: pointer;
    }

    .menu-item:hover {
        transform: translateY(-4px);
    }

    .menu-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .menu-item h5 {
        font-weight: bold;
        margin: 15px 0 5px;
        font-size: 1.1rem;
    }

    .menu-item p {
        margin-bottom: 10px;
        color: #333;
        font-weight: bold;
    }

    .menu-item .btn {
        margin-bottom: 15px;
        width: 80%;
        transition: all 0.2s ease;
    }

    .menu-item .btn:hover {
        background-color: #28a745cc;
        color: #fff;
        transform: scale(1.05);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.6);
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 500px;
        position: relative;
        animation: fadeInScale 0.3s ease forwards;
        transform-origin: center center;
    }

    .close {
        position: absolute;
        right: 12px;
        top: 12px;
        font-size: 28px;
        color: #666;
        cursor: pointer;
        transition: color 0.3s ease;
        user-select: none;
    }

    .close:hover {
        color: #d32f2f;
    }

    @keyframes fadeInScale {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @media (max-width: 768px) {
        .hero {
            padding: 40px 20px;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .modal-content {
            width: 95% !important;
            margin: 5% auto !important;
            padding: 15px 20px !important;
        }
    }
</style>

<div class="hero">
    <div class="container hero-content">
        <div class="row">
            <div class="col-md-7">
                <h1>Menu Tradisional Lezat</h1>
                <h3>LAKSA & ASINAN BETAWI</h3>
                <p>Rasakan cita rasa khas Betawi langsung dari dapur terbaik!</p>
                <a href="{{ auth()->check() && auth()->user()->role === 'customer' ? route('checkout') : route('login') }}"
                   class="btn btn-primary mt-2">
                    Pesan Sekarang
                </a>
                <p class="mt-3">
                    Hanya dari <strong>Rp 10.000</strong> — Dijamin kenyang dan puas!
                </p>
            </div>
        </div>
    </div>
</div>

<div class="text-center mb-4">
    <div class="promo-text">
        🍜 Laksa Gurih Pedas &nbsp;&nbsp;🥗 Asinan Segar &nbsp;&nbsp;💸 Bayar Only via QRIS
    </div>
</div>

{{-- Form Search --}}
<div class="container mb-4">
    <form action="{{ route('home') }}" method="GET" class="d-flex justify-content-center">
        <input type="text" name="search" class="form-control me-2" style="max-width: 300px;"
               placeholder="Cari makanan..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-success">Cari</button>
    </form>
</div>

<div class="container mb-5">
    <h3 class="menu-title">Menu Kami</h3>

    <div class="menu-wrapper">  
        <div class="menu-grid">
            @forelse ($foods as $food)
                <div class="menu-item" onclick="openModal({{ $food->id }})" tabindex="0" role="button" onkeypress="if(event.key === 'Enter'){ openModal({{ $food->id }}) }">
                    <img src="{{ asset('storage/' . ($food->image ?? 'laksa.png')) }}" alt="{{ $food->name }}" loading="lazy">
                    <h5>{{ $food->name }}</h5>
                    <p>Rp{{ number_format($food->price, 0, ',', '.') }}</p>
                    @if(auth()->check() && auth()->user()->role === 'customer')
                        <a href="{{ route('checkout') }}" class="btn btn-success">
                            Pesan Sekarang
                        </a>
                    @endif
                </div>

                {{-- Modal --}}
                <div id="modal-{{ $food->id }}" class="modal" aria-hidden="true" role="dialog" aria-labelledby="modal-title-{{ $food->id }}" tabindex="-1">
                    <div class="modal-content">
                        <span class="close" aria-label="Close modal" onclick="closeModal({{ $food->id }})">&times;</span>
                        <img src="{{ asset('storage/' . ($food->image ?? 'laksa.png')) }}" alt="{{ $food->name }}" loading="lazy" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                        <h3 id="modal-title-{{ $food->id }}" style="margin-top: 16px;">{{ $food->name }}</h3>
                        <p><strong>Harga:</strong> Rp{{ number_format($food->price, 0, ',', '.') }}</p>
                        <p><strong>Deskripsi:</strong> {{ $food->description ?? 'Belum ada deskripsi.' }}</p>
                        @if(auth()->check() && auth()->user()->role === 'customer')
                            <a href="{{ route('checkout') }}" class="btn btn-primary mt-2">
                                Pesan Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Tidak ada menu ditemukan untuk: <strong>{{ request('search') }}</strong></p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.style.display = 'block';
        modal.setAttribute('aria-hidden', 'false');
        modal.focus();
    }

    function closeModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
    }

    window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = "none";
                modal.setAttribute('aria-hidden', 'true');
            }
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.style.display = 'none';
                modal.setAttribute('aria-hidden', 'true');
            });
        }
    });
</script>

@endsection
