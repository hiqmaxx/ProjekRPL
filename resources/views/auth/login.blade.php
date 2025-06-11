@extends('layouts.guest')

@section('content')
<style>
    body {
        background-color: #2e7d32;
        font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
        max-width: 400px;
        margin: auto;
        margin-top: 10vh;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        padding: 30px 25px;
    }

    .login-title {
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

    .btn-login {
        background-color: #2e7d32;
        color: white;
        font-weight: bold;
        width: 100%;
    }

    .btn-login:hover {
        background-color: #1b5e20;
    }

    .small-link {
        text-align: right;
        display: block;
        margin-bottom: 12px;
    }

    .footer-link {
        text-align: center;
        margin-top: 16px;
        font-size: 0.9rem;
    }
</style>

<div class="login-card">
    <div class="login-title">
        <i class="bi bi-person-circle me-2"></i> MASUK
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3 position-relative">
            <i class="bi bi-person form-icon"></i>
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

        <a class="small-link" href="{{ route('password.request') }}">Lupa Password?</a>

        <button type="submit" class="btn btn-login mb-2">MASUK</button>

        <div class="footer-link">
            Belum punya akun? <a href="{{ route('register') }}"><strong>REGISTRASI</strong></a>
        </div>
    </form>
</div>
@endsection
