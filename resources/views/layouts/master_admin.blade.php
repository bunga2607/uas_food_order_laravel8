<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }

        .navbar {
            background: linear-gradient(to right, #0d6efd, #00c6ff);
        }

        .sidebar {
            height: 100vh;
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .sidebar h5 {
            padding-left: 10px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 8px 14px;
            display: block;
            transition: 0.2s;
            border-radius: 4px;
        }

        .sidebar a:hover,
        .sidebar .nav-link.active {
            background-color: #3498db;
            color: #fff;
            padding-left: 18px;
        }

        .content {
            margin-left: 230px;
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
        .dark-mode .sidebar .nav-link.active {
            background-color: #007bff;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand h5 mb-0 text-white">Sistem Pemesanan Makanan - Admin Panel</span>
</nav>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3 position-fixed" style="width:230px;">
        <h5 class="mb-4">Menu Admin</h5>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('admin/foods*') ? 'active' : '' }}" href="{{ route('admin.foods.index') }}">
                    <i class="bi bi-basket"></i> Kelola Makanan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                    <i class="bi bi-box"></i> Kelola Pesanan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('admin/laporan') ? 'active' : '' }}" href="{{ route('admin.report.index') }}">
                    <i class="bi bi-clipboard-data"></i> Laporan Penjualan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('admin/ratings') ? 'active' : '' }}" href="{{ route('admin.ratings.index') }}">
                    <i class="bi bi-star"></i> Ulasan & Rating
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('admin/kontak') ? 'active' : '' }}" href="{{ route('admin.kontak.edit') }}">
                    <i class="bi bi-telephone"></i> Kontak Admin
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('admin/profil') ? 'active' : '' }}" href="{{ route('admin.profil.edit') }}">
                    <i class="bi bi-person-circle"></i> Profil Saya
                </a>
            </li>
            <li class="nav-item mt-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light w-100" type="submit">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </button>
                </form>
            </li>
            <li class="mt-3">
                <div class="form-check form-switch text-white">
                    <input class="form-check-input" type="checkbox" id="dark-mode-toggle">
                    <label class="form-check-label" for="dark-mode-toggle">Dark Mode</label>
                </div>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content flex-grow-1">
        @yield('content')
    </div>
</div>

<!-- JS -->
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
