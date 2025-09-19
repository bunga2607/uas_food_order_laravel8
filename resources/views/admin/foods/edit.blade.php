@extends('layouts.master_admin')

@section('content')
<div class="container mt-4">
    <h4>Edit Makanan</h4>
    <form action="{{ route('admin.foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama Makanan</label>
            <input type="text" name="name" value="{{ $food->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" value="{{ $food->price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $food->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar Lama:</label><br>
            @if($food->image)
                <img src="{{ asset('images/' . $food->image) }}" width="100">
            @else
                <em>Tidak ada gambar</em>
            @endif
        </div>

        <div class="mb-3">
            <label>Ganti Gambar (Opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
