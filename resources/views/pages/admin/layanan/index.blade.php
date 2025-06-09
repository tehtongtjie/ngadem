@extends('layouts.Admin.app')

@section('title', 'Daftar Layanan')

@section('content')

    <!-- Title Section -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-weight: 700;">Daftar Layanan</h1>
        <a href="{{ route('admin.layanan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Baru
        </a>
    </div>

    <!-- Service List Table Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Layanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th>Harga Dasar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($layanans as $layanan)
                            <tr>
                                <td>{{ $layanan->id }}</td>
                                <td>{{ $layanan->nama_layanan }}</td>
                                <td>{{ Str::limit($layanan->deskripsi, 50, '...') }}</td>
                                <td>Rp {{ number_format($layanan->harga_dasar, 2, ',', '.') }}</td>
                                <td>
                                    @php
                                        $statusText = ucfirst($layanan->status ?? 'Tidak Diketahui');
                                        $badgeClass = 'badge-secondary'; // Default badge color
                                        switch (strtolower($layanan->status ?? '')) {
                                            case 'aktif':
                                                $badgeClass = 'badge-success';
                                                break;
                                            case 'nonaktif':
                                                $badgeClass = 'badge-danger';
                                                break;
                                            default:
                                                $badgeClass = 'badge-info'; // For other statuses like 'draft'
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.layanan.show', $layanan->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('admin.layanan.edit', $layanan->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus layanan ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data layanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
