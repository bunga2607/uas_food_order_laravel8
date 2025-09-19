<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User Panel - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }

        .navbar {
            background: linear-gradient(to right, #0d6efd, #00c6ff);
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .sidebar h4 {
            padding-left: 10px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 4px;
            transition: 0.2s;
        }

        .sidebar a:hover,
        .sidebar .active {
            background-color: #3498db;
            color: #fff;
            padding-left: 20px;
        }

        .content {
            margin-left: 250px;
            padding: 25px;
        }

        /* Dark Mode */
        body.dark-mode {
            background-color: #121212;
            color: #f1f1f1;
        }

        .dark-mode .card,
        .dark-mode .table {
            background-color: #1e1e1e;
            color: #f1f1f1;
        }

        .dark-mode .table th {
            background-color: #333;
        }

        .dark-mode .btn,
        .dark-mode .form-control {
            background-color: #2c2c2c;
            color: #fff;
        }

        .dark-mode .sidebar {
            background-color: #1a1a1a;
        }

        .dark-mode .sidebar a:hover,
        .dark-mode .sidebar .active {
            background-color: #007bff;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand h5 mb-0 text-white">Sistem Pemesanan Makanan - User Panel</span>
</nav>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3 position-fixed">
        <h4 class="mb-4">User Panel</h4>
        <a href="{{ route('user.dashboard') }}" class="{{ request()->is('user/dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        <a href="{{ route('user.foods.index') }}" class="{{ request()->is('user/foods') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i> Pesan Makanan
        </a>
        <a href="{{ route('user.orders.history') }}" class="{{ request()->is('user/orders/history') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Riwayat Pesanan
        </a>
        <a href="{{ route('user.kontak') }}" class="{{ request()->is('user/kontak') ? 'active' : '' }}">
            <i class="bi bi-telephone"></i> Kontak Kami
        </a>
        <a href="{{ route('user.profil.edit') }}" class="{{ request()->is('user/profil') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Edit Profil
        </a>

        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>

        <!-- Dark Mode Toggle -->
        <div class="form-check form-switch text-white mt-4">
            <input class="form-check-input" type="checkbox" id="dark-mode-toggle">
            <label class="form-check-label" for="dark-mode-toggle">Dark Mode</label>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content flex-grow-1">
        @yield('content')
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('dark-mode-toggle');
        const currentTheme = localStorage.getItem('theme');

        if (currentTheme === 'dark') {
            document.body.classList.add('dark-mode');
            if (toggle) toggle.checked = true;
        }

        if (toggle) {
            toggle.addEventListener('change', function () {
                if (this.checked) {
                    document.body.classList.add('dark-mode');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.body.classList.remove('dark-mode');
                    localStorage.setItem('theme', 'light');
                }
            });
        }
    });
</script>
</body>
</html>
