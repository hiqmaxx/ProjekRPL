<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAXIVA - Laksa & Asinan Betawi</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo laxiva.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .top-bar-wrapper {
            width: 100%;
            padding: 10px 0;
            display: flex;
            justify-content: center;
            background-color: #7BC043;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .top-bar-inner {
            background-color: transparent;
            width: 100%;
            max-width: 1200px;
            font-size: 0.85rem;
            color: #ffffff;
            padding: 6px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar-inner a {
            color: #ffffff;
            text-decoration: none;
        }

        .top-bar-inner a:hover {
            text-decoration: underline;
        }

        .navbar {
            background-color: #ffffff !important;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #ddd;
        }

        .navbar-brand img {
            height: 56px;
        }

        .nav-link {
            color: #444 !important;
            font-weight: 500;
            padding: 10px 15px;
        }

        .nav-link:hover {
            color: #7BC043 !important;
        }

        .icon-btn {
            background: none;
            border: none;
            position: relative;
            font-size: 1.25rem;
            color: #7BC043;
            margin-left: 10px;
        }

        .icon-btn .badge {
            font-size: 0.7rem;
            position: absolute;
            top: -5px;
            right: -10px;
        }

        .dropdown-menu a {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar-wrapper">
        <div class="top-bar-inner">
            <div>
                <i class="bi bi-geo-alt-fill"></i> SMKN 8 Jakarta
                &nbsp; | &nbsp;
                <i class="bi bi-envelope-fill"></i> laxiva@gmail.com
            </div>
            <div>
                <a href="{{ route('privacy') }}">Privacy Policy</a> /
                <a href="{{ route('terms') }}">Terms of Use</a> /
                <a href="{{ route('contact') }}">Sales and Refunds</a>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand mx-auto" href="{{ url('/') }}">
                <img src="{{ asset('storage/logo laxiva.png') }}" alt="LAXINA Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('foods.index') }}">Kelola Makanan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}">Pesanan Masuk</a>
                            </li>
                        @elseif(auth()->user()->role === 'customer')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.my') }}">
                                    <i class="bi bi-clock-history me-1"></i> Riwayat Pesanan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="icon-btn" href="{{ route('checkout') }}">
                                    <i class="bi bi-cart4"></i>
                                </a>
                            </li>
                        @endif

                        <!-- Dropdown Profil -->
                        <li class="nav-item dropdown">
                            <a class="icon-btn dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="bi bi-person-lines-fill me-1"></i> Profil Saya
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
