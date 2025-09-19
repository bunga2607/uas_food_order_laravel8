@extends('layouts.master_user')

@section('title', 'Dashboard User')

@section('content')
    <div class="text-center mt-5">
        <h1 class="fw-bold" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 2.2rem;">
            👋 Hai, {{ Auth::user()->name }}!
        </h1>
        <p class="text-muted fs-5 mt-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            Selamat datang di sistem pemesanan makanan. Silakan pilih menu makanan favoritmu atau cek riwayat pesanan di panel sebelah.
        </p>
    </div>
@endsection
