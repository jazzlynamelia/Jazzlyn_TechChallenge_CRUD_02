@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Penulis</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penulis.update', $penulis->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Penulis</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $penulis->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat">{{ old('alamat', $penulis->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tlep" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" name="tlep" value="{{ old('tlep', $penulis->tlep) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('penulis.view') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
