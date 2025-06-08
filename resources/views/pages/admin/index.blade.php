@extends('layouts.Admin.app') {{-- Assuming you have a layout file for SB Admin 2, e.g., 'layouts.admin' --}}

@section('title', 'Dashboard Admin')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 style="font-weight: 700;" class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
        {{-- Optional: Add a button for actions, e.g., "Add New" --}}
        {{--
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Baru
        </a>
        --}}
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
                                <th>Teknisi</th>
                                <th>Status</th>
                                <th>Jadwal Layanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestLayanan as $index => $layanan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $layanan->nama_layanan ?? '-' }}</td>
                                    <td>
                                        {{-- Prioritize 'name' if it exists (e.g., from User model), otherwise use 'nama_teknisi' --}}
                                        {{ $layanan->teknisi->name ?? ($layanan->teknisi->nama_teknisi ?? '-') }}
                                    </td>
                                    <td>
                                        @php
                                            $statusText = ucfirst($layanan->status ?? 'Tidak Diketahui');
                                            $badgeClass = 'badge-secondary'; // Default badge color
                                            switch (strtolower($layanan->status ?? '')) {
                                                case 'selesai':
                                                    $badgeClass = 'badge-success';
                                                    break;
                                                case 'dijadwalkan':
                                                    $badgeClass = 'badge-info';
                                                    break;
                                                case 'berlangsung':
                                                    $badgeClass = 'badge-warning';
                                                    break;
                                                case 'dibatalkan':
                                                    $badgeClass = 'badge-danger';
                                                    break;
                                                case 'pending':
                                                    $badgeClass = 'badge-primary'; // Using primary for pending
                                                    break;
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        {{ $layanan->jadwal_layanan ? \Carbon\Carbon::parse($layanan->jadwal_layanan)->translatedFormat('d M Y, H:i') : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> Belum ada data layanan terbaru.
                </div>
            @endif
        </div>
    </div>
@endsection
