@extends('layouts.master_user')

@section('title', 'Daftar Makanan')

@section('content')
<div class="container mt-4">
    <h4>Daftar Makanan Tersedia</h4>
    <a href="{{ route('user.order.create') }}" class="btn btn-primary mb-3">Pesan Sekarang</a>
    <div class="row">
        @foreach($foods as $food)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                @if($food->image)
                    <img src="{{ asset('images/' . $food->image) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $food->name }}</h5>
                    <p class="card-text">{{ $food->description }}</p>
                    <p class="text-success">Rp {{ number_format($food->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
