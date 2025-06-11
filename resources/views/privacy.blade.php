@extends('layouts.app')

@section('content')
<style>
    .policy-header {
        background: linear-gradient(to right, #7BC043, #a6e05f);
        color: white;
        padding: 60px 0;
        text-align: center;
        border-radius: 0 0 30px 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .policy-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 30px;
        margin-bottom: 20px;
        animation: fadeInUp 0.4s ease-in-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .policy-section h5 {
        color: #7BC043;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .policy-section p {
        color: #333;
        line-height: 1.7;
    }

    .contact-info {
        background-color: #f9f9f9;
        padding: 25px;
        border-left: 4px solid #7BC043;
        border-radius: 8px;
    }
</style>

<div class="policy-header">
    <div class="container">
        <h1 class="display-5 fw-bold">Kebijakan Privasi</h1>
        <p class="mb-0">Terakhir Diperbarui: {{ now()->format('d F Y') }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="policy-section">
        <h5><i class="bi bi-info-circle-fill"></i> 1. Informasi yang Kami Kumpulkan</h5>
        <p>Kami mengumpulkan data seperti nama, email, nomor telepon, dan detail pesanan Anda ketika Anda menggunakan layanan kami.</p>
    </div>

    <div class="policy-section">
        <h5><i class="bi bi-shield-lock-fill"></i> 2. Penggunaan Informasi</h5>
        <p>Informasi pribadi Anda digunakan untuk memproses transaksi, memberikan layanan pelanggan, dan meningkatkan pengalaman pengguna Anda.</p>
    </div>

    <div class="policy-section">
        <h5><i class="bi bi-lock-fill"></i> 3. Keamanan Data</h5>
        <p>Kami menjaga keamanan data Anda dengan menggunakan teknologi enkripsi dan sistem keamanan terbaik yang tersedia.</p>
    </div>

    <div class="policy-section">
        <h5><i class="bi bi-cookie"></i> 4. Penggunaan Cookies</h5>
        <p>Kami menggunakan cookies untuk memahami preferensi Anda dan meningkatkan pengalaman di situs kami.</p>
    </div>

    <div class="policy-section">
        <h5><i class="bi bi-arrow-repeat"></i> 5. Perubahan Kebijakan</h5>
        <p>Kami berhak mengubah kebijakan ini kapan saja. Semua perubahan akan diinformasikan melalui halaman ini.</p>
    </div>

    <div class="policy-section contact-info">
        <h5><i class="bi bi-envelope-paper-fill"></i> 6. Hubungi Kami</h5>
        <p>Jika Anda memiliki pertanyaan atau masukan tentang kebijakan ini, hubungi kami melalui email: <strong>laxiva@gmail.com</strong>.</p>
    </div>
</div>
@endsection
