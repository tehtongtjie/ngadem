@extends('layouts.Admin.app') {{-- Pastikan Anda memiliki layout admin yang benar yang sudah mengimpor Bootstrap 4 dan SB Admin 2 assets --}}

@section('title', 'Daftar Teknisi')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 style="font-weight: 700; "class="h3 mb-0 text-gray-800">Daftar Teknisi</h1>
        <a href="{{ route('admin.teknisi.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Teknisi Baru
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Teknisi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            {{--<th>Spesialisasi</th>--}}
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    {{-- Optional: Add a <tfoot> if you're using DataTables JS --}}
                    {{--
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    --}}
                    <tbody>
                        @forelse ($teknisi as $teknisiItem)
                            <tr>
                                <td>{{ $teknisiItem->id }}</td>
                                <td>{{ $teknisiItem->name }}</td>
                                <td>{{ $teknisiItem->email }}</td>
                                <td>{{ ucfirst($teknisiItem->role) }}</td>
                                {{--<td>{{ $teknisiItem->detail->spesialisasi ?? '-' }}</td> --}}
                                <td>{{ $teknisiItem->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.teknisi.show', $teknisiItem->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('admin.teknisi.edit', $teknisiItem->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.teknisi.destroy', $teknisiItem->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus teknisi ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data teknisi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
