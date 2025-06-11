@extends('layouts.guest')

@section('content')
<style>
    body {
        background-color: #2e7d32;
        font-family: 'Segoe UI', sans-serif;
    }

    .register-card {
        max-width: 450px;
        margin: auto;
        margin-top: 8vh;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        padding: 30px 25px;
    }

    .register-title {
        font-size: 24px;
        font-weight: bold;
        color: #2e7d32;
        text-align: center;
        margin-bottom: 24px;
    }

    .form-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #2e7d32;
    }

    .form-control {
        padding-left: 36px;
    }

    .btn-register {
        background-color: #2e7d32;
        color: white;
        font-weight: bold;
        width: 100%;
    }

    .btn-register:hover {
        background-color: #1b5e20;
    }

    .footer-link {
        text-align: center;
        margin-top: 16px;
        font-size: 0.9rem;
    }
</style>

<div class="register-card">
    <div class="register-title">
        <i class="bi bi-person-plus me-2"></i> REGISTRASI
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3 position-relative">
            <i class="bi bi-person form-icon"></i>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required placeholder="Nama Lengkap">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 position-relative">
            <i class="bi bi-envelope form-icon"></i>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required placeholder="Email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 position-relative">
            <i class="bi bi-lock form-icon"></i>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required placeholder="Password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 position-relative">
            <i class="bi bi-shield-lock form-icon"></i>
            <input type="password" class="form-control"
                   name="password_confirmation" required placeholder="Konfirmasi Password">
        </div>

        <!-- Role -->
        <div class="mb-3 position-relative">
            <i class="bi bi-person-badge form-icon"></i>
            <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Kode Unik (hanya untuk Admin) -->
        <div class="mb-3 position-relative" id="kodeUnikContainer" style="display: none;">
            <i class="bi bi-key form-icon"></i>
            <input type="text" class="form-control @error('kode_unik') is-invalid @enderror"
                   name="kode_unik" placeholder="Kode Unik Admin" value="{{ old('kode_unik') }}">
            @error('kode_unik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-register mb-2">DAFTAR</button>

        <div class="footer-link">
            Sudah punya akun? <a href="{{ route('login') }}"><strong>MASUK</strong></a>
        </div>
    </form>
</div>

<script>
    const roleSelect = document.getElementById('role');
    const kodeUnikContainer = document.getElementById('kodeUnikContainer');

    function toggleKodeUnik() {
        if (roleSelect.value === 'admin') {
            kodeUnikContainer.style.display = 'block';
        } else {
            kodeUnikContainer.style.display = 'none';
        }
    }

    roleSelect.addEventListener('change', toggleKodeUnik);
    window.addEventListener('DOMContentLoaded', toggleKodeUnik); // on load
</script>
@endsection
