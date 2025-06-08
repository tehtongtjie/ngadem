@extends('layouts.Admin.app') {{-- Pastikan Anda memiliki layout admin yang benar yang sudah mengimpor Bootstrap 4 dan SB Admin 2 assets --}}

@section('title', 'Daftar Ulasan')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Ulasan</h1>
        {{-- Optional: Add a button for actions, e.g., "Add New Review" if applicable --}}
        {{-- <a href="{{ route('admin.ulasan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Ulasan Baru
        </a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Ulasan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order ID</th>
                            <th>Pengguna</th>
                            <th>Teknisi</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    {{-- Optional: Add a <tfoot> if you're using DataTables JS --}}
                    {{--
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Order ID</th>
                            <th>Pengguna</th>
                            <th>Teknisi</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    --}}
                    <tbody>
                        @forelse ($ulasan as $u)
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td>{{ $u->order_id }}</td>
                                <td>{{ $u->user->name ?? '-' }}</td>
                                <td>{{ $u->teknisi->name ?? '-' }}</td>
                                <td>{{ $u->rating }} / 5</td>
                                <td>{{ $u->komentar ?? '-' }}</td>
                                <td>{{ $u->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('ulasan.show', $u->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('ulasan.edit', $u->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('ulasan.destroy', $u->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data ulasan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
