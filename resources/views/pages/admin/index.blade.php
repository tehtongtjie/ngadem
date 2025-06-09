@extends('layouts.Admin.app')

@section('title', 'Dashboard Admin')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 style="font-weight: 700;" class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
        <a href="{{ route('admin.layanan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Layanan Baru
        </a>
    </div>

    <hr class="sidebar-divider my-0 mb-4">

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pelanggan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPelanggan ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Teknisi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTeknisi ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wrench fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Layanan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLayanan ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="sidebar-divider my-0 mb-4">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">5 Layanan Terbaru</h6>
        </div>
        <div class="card-body">
            @if (isset($latestLayanan) && $latestLayanan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Layanan</th>
                                <th>Deskripsi</th>
                                <th>Harga Dasar</th>
                                <th>Status</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th> {{-- Kolom Aksi --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestLayanan as $layanan)
                                {{-- <-- KOREKSI DI SINI --}}
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $layanan->nama_layanan ?? '-' }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($layanan->deskripsi, 50, '...') }}</td>
                                    <td>Rp {{ number_format($layanan->harga_dasar, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusText = ucfirst($layanan->status ?? 'Tidak Diketahui');
                                            $badgeClass = 'badge-secondary';
                                            switch (strtolower($layanan->status ?? '')) {
                                                case 'aktif':
                                                    $badgeClass = 'badge-success';
                                                    break;
                                                case 'nonaktif':
                                                    $badgeClass = 'badge-danger';
                                                    break;
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($layanan->created_at)->format('d M Y, H:i') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.layanan.show', $layanan->id) }}"
                                            class="btn btn-info btn-sm" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.layanan.edit', $layanan->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit Layanan">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-gray-600">Belum ada data layanan terbaru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> Belum ada data layanan untuk ditampilkan.
                </div>
            @endif
        </div>
    </div>
@endsection
