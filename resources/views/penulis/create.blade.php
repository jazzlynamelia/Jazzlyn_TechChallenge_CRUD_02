@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Penulis Baru</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penulis.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Penulis</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat">{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tlep" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" name="tlep" value="{{ old('tlep') }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('penulis.view') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
