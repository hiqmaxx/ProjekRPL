<!DOCTYPE html>
<html>
<head>
    <title>Website Laksa & Asinan Betawi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Laksa & Asinan</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('foods.index') }}">Kelola Makanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Pesanan Masuk</a></li>
                    @elseif(auth()->user()->role === 'customer')
                        <li class="nav-item"><a class="nav-link" href="{{ route('checkout') }}">Checkout</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('orders.my') }}">Pesanan Saya</a></li>
                    @endif
                    <li class="nav-item"><span class="nav-link">{{ auth()->user()->name }}</span></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-link nav-link" type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
