@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Penulis</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('penulis.create') }}" class="btn btn-primary mb-3">+ Tambah Penulis</a>

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
            @forelse($penulis as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat ?? '-' }}</td>
                    <td>{{ $item->tlep ?? '-' }}</td>
                    <td>
                        <a href="{{ route('penulis.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('penulis.delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus penulis ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data penulis</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection