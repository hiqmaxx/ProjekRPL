<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>@yield('title', 'Login')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Tambahkan style tambahan jika perlu --}}
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>