<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar - FoodOrder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: linear-gradient(to right, #0066ff, #0099ff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-container {
            background: #1c1c1c;
            color: #fff;
            border-radius: 15px;
            display: flex;
            max-width: 850px;
            width: 100%;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }
        .logo-panel {
            background-color: #000;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        .logo-panel img {
            width: 100px;
            margin-bottom: 10px;
        }
        .logo-panel h1 {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
        .form-panel {
            flex: 1.2;
            padding: 40px;
            background-color: #222;
        }
        .form-panel h2 {
            font-size: 22px;
            margin-bottom: 25px;
        }
        .form-control {
            background-color: #333;
            border: none;
            color: #fff;
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .btn-register {
            background: #007bff;
            border: none;
        }
        .btn-register:hover {
            background: #0056b3;
        }
        .text-link a {
            color: #50bfff;
            text-decoration: none;
        }
        .text-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="logo-panel">
        <img src="{{ asset('images/logo-foodorder.png') }}" alt="Logo">
        <h1>FoodOrder</h1>
    </div>
    <div class="form-panel">
        <h2>Daftar Akun Baru</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label>Kata Sandi</label>
                <input type="password" name="password" class="form-control" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label>Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="form-control" required autocomplete="off">
            </div>

            {{-- Jika ingin tambahkan role manual saat testing --}}
            <div class="mb-3">
                <label>Role <small class="text-muted">(sementara)</small></label>
                <select name="role" class="form-control" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-register text-white">Daftar</button>
            </div>

            <p class="text-link text-center mt-3">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>
