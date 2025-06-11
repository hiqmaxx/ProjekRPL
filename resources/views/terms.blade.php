@extends('layouts.app')

@section('content')
<style>
    .terms-header {
        background: linear-gradient(to right, #7BC043, #a6e05f);
        color: white;
        padding: 60px 0;
        text-align: center;
        border-radius: 0 0 30px 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .terms-container {
        padding: 40px 15px;
    }

    .terms-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 30px;
        margin-bottom: 20px;
        animation: fadeInUp 0.4s ease-in-out;
    }

    .terms-section h5 {
        color: #7BC043;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .terms-section p {
        color: #333;
        line-height: 1.7;
    }

    .contact-box {
        background-color: #f9f9f9;
        padding: 25px;
        border-left: 4px solid #7BC043;
        border-radius: 8px;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="terms-header">
    <div class="container">
        <h1 class="display-5 fw-bold">Syarat & Ketentuan</h1>
        <p class="mb-0">Harap baca dengan seksama sebelum menggunakan layanan kami.</p>
    </div>
</div>

<div class="container terms-container">
    <div class="terms-section">
        <h5><i class="bi bi-check-circle-fill me-2"></i>1. Persetujuan</h5>
        <p>Dengan menggunakan layanan kami, Anda menyetujui seluruh syarat dan ketentuan yang berlaku di platform LAXIVA.</p>
    </div>

    <div class="terms-section">
        <h5><i class="bi bi-cart-fill me-2"></i>2. Pemesanan</h5>
        <p>Setiap pemesanan yang dilakukan melalui sistem kami bersifat final. Pastikan detail pesanan sudah benar sebelum checkout.</p>
    </div>

    <div class="terms-section">
        <h5><i class="bi bi-currency-dollar me-2"></i>3. Pembayaran</h5>
        <p>Pembayaran hanya diterima melalui metode QRIS. Pembayaran yang berhasil tidak dapat dikembalikan.</p>
    </div>

    <div class="terms-section">
        <h5><i class="bi bi-person-bounding-box me-2"></i>4. Akun Pengguna</h5>
        <p>Setiap pengguna bertanggung jawab atas keamanan akun masing-masing. Jangan berikan kredensial ke pihak lain.</p>
    </div>

    <div class="terms-section">
        <h5><i class="bi bi-shield-exclamation me-2"></i>5. Pelanggaran</h5>
        <p>Kami berhak menangguhkan atau menghapus akun pengguna yang melanggar ketentuan atau melakukan aktivitas mencurigakan.</p>
    </div>

    <div class="terms-section contact-box">
        <h5><i class="bi bi-envelope-paper-fill me-2"></i>6. Hubungi Kami</h5>
        <p>Jika Anda memiliki pertanyaan, silakan hubungi kami melalui email: <strong>laxiva@gmail.com</strong>.</p>
    </div>
</div>
@endsection
