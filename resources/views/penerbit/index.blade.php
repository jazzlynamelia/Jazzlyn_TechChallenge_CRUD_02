@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Penerbit</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('penerbit.create') }}" class="btn btn-primary mb-3">Tambah Penerbit</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penerbits as $penerbit)
                <tr>
                    <td>{{ $penerbit->nama }}</td>
                    <td>{{ $penerbit->alamat ?? '-' }}</td>
                    <td>{{ $penerbit->tlep ?? '-' }}</td>
                    <td>
                        <a href="{{ route('penerbit.edit', $penerbit->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('penerbit.delete', $penerbit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus penerbit ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
