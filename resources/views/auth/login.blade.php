<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - FoodOrder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: linear-gradient(to right, #0066ff, #0099ff); /* senada dengan tombol masuk */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
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
        .btn-login {
            background: #007bff;
            border: none;
        }
        .btn-login:hover {
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

<div class="login-container">
    <div class="logo-panel">
        <img src="{{ asset('images/logo-foodorder.png') }}" alt="Logo">
        <h1>FoodOrder</h1>
    </div>
    <div class="form-panel">
        <h2>Login ke Akun Anda</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email">Alamat Email</label>
                <input id="email" type="email" name="email" class="form-control" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="password">Kata Sandi</label>
                <input id="password" type="password" name="password" class="form-control" required autocomplete="off">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-login text-white">Masuk</button>
            </div>

            <p class="text-link text-center mt-3">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>
