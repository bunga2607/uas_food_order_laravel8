@extends('layouts.master_admin')

@section('content')
<div class="container mt-4">
    <h4>Daftar Makanan</h4>
    <a href="{{ route('admin.foods.create') }}" class="btn btn-primary mb-3">Tambah Makanan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foods as $food)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($food->image)
                            <img src="{{ asset('images/' . $food->image) }}" width="80">
                        @else
                            <em>Tidak ada</em>
                        @endif
                    </td>
                    <td>{{ $food->name }}</td>
                    <td>Rp {{ number_format($food->price, 0, ',', '.') }}</td>
                    <td>{{ $food->description }}</td>
                    <td>
                        <a href="{{ route('admin.foods.edit', $food->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
