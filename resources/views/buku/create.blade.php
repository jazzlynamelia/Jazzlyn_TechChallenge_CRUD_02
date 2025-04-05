@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Tambah Buku Baru</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('buku.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" required>
        </div>

        <div class="mb-3">
            <label for="penulis_id" class="form-label">Penulis</label>
            <select name="penulis_id" class="form-select" required>
                <option value="">-- Pilih Penulis --</option>
                @foreach($penulis as $p)
                    <option value="{{ $p->id }}" {{ old('penulis_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="penerbit_id" class="form-label">Penerbit</label>
            <select name="penerbit_id" class="form-select" required>
                <option value="">-- Pilih Penerbit --</option>
                @foreach($penerbit as $pb)
                    <option value="{{ $pb->id }}" {{ old('penerbit_id') == $pb->id ? 'selected' : '' }}>
                        {{ $pb->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan Buku</button>
        <a href="{{ route('buku.view') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
