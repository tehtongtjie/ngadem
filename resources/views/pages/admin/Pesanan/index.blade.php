@extends('layouts.Admin.app') {{-- Pastikan layout ini benar --}}

@section('title', 'Daftar Pesanan')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pesanan</h1>
        {{-- Optional: Add a button for creating new orders if applicable --}}
        {{-- <a href="{{ route('admin.pesanan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pesanan Baru
        </a> --}}
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Periksa apakah ada data pesanan (koleksi paginator tidak akan pernah "null" tapi bisa empty) --}}
    @if ($pesanan->count() > 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pesanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pelanggan</th>
                                <th>Teknisi</th>
                                <th>Layanan</th>
                                <th>Status</th>
                                <th>Tanggal Pesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $index => $item)
                                <tr>
                                    {{-- Menggunakan firstItem() untuk nomor urut global per halaman --}}
                                    <td>{{ $pesanan->firstItem() + $index }}</td>
                                    {{-- Mengakses nama user dari relasi user --}}
                                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                                    {{-- Mengakses nama teknisi dari relasi teknisi --}}
                                    <td>{{ $item->teknisi->name ?? 'Belum Ditugaskan' }}</td>
                                    {{-- Mengakses nama layanan dari relasi service --}}
                                    <td>{{ $item->service->nama_layanan ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $statusText = ucfirst(
                                                str_replace('_', ' ', $item->status_order ?? 'tidak_diketahui'),
                                            );
                                            $badgeClass = 'badge-secondary'; // Default badge color
                                            switch (strtolower($item->status_order ?? '')) {
                                                case 'selesai':
                                                    $badgeClass = 'badge-success';
                                                    break;
                                                case 'pending':
                                                    $badgeClass = 'badge-info'; // Menggunakan info untuk pending, mirip yellow
                                                    break;
                                                case 'diterima':
                                                    $badgeClass = 'badge-primary'; // Menggunakan primary untuk diterima
                                                    break;
                                                case 'dalam_proses':
                                                    $badgeClass = 'badge-warning';
                                                    break;
                                                case 'dibatalkan':
                                                    $badgeClass = 'badge-danger';
                                                    break;
                                                default:
                                                    $badgeClass = 'badge-dark'; // Fallback for unknown status
                                                    break;
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d M Y H:i') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pesanan.show', $item->id) }}" class="btn btn-info btn-sm"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.pesanan.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit Pesanan">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- Optional: Delete button for orders --}}
                                        {{-- <form action="{{ route('admin.pesanan.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Pesanan"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Menampilkan link paginasi --}}
        <div class="d-flex justify-content-center">
            {{ $pesanan->links('pagination::bootstrap-4') }} {{-- Menggunakan Laravel's built-in Bootstrap 4 pagination view --}}
        </div>
    @else
        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle"></i> Belum ada data pesanan.
        </div>
    @endif
@endsection
