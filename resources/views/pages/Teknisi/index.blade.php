@extends('layouts.teknisi.app') {{-- Pastikan Anda memiliki layout untuk teknisi, e.g., 'layouts.teknisi' --}}

@section('title', 'Dashboard Teknisi')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Dashboard Teknisi</h1>
        {{-- Optional: Add a button for actions, e.g., "View All Orders" --}}
        {{--
        <a href="{{ route('teknisi.pesanan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="fas fa-list fa-sm text-white-50"></i> Lihat Semua Pesanan
        </a>
        --}}
    </div>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pesanan Diterima
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPesananDiterima ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pesanan Selesai
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPesananSelesai ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pesanan Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPesananPending ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesanan Terbaru Anda</h6>
        </div>
        <div class="card-body">
            @if (isset($latestPesanan) && $latestPesanan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Status</th>
                                <th>Tanggal Diharapkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestPesanan as $index => $pesananItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pesananItem->user->name ?? '-' }}</td>
                                    <td>{{ $pesananItem->service->nama_layanan ?? '-' }}</td>
                                    <td>
                                        @php
                                            $statusText = ucfirst($pesananItem->status_order ?? 'Tidak Diketahui');
                                            $badgeClass = 'badge-secondary'; // Default
                                            switch (strtolower($pesananItem->status_order ?? '')) {
                                                case 'selesai':
                                                    $badgeClass = 'badge-success';
                                                    break;
                                                case 'pending':
                                                    $badgeClass = 'badge-warning'; // Using warning for pending
                                                    break;
                                                case 'diterima':
                                                    $badgeClass = 'badge-info';
                                                    break;
                                                case 'dalam_proses':
                                                    $badgeClass = 'badge-primary'; // Using primary for in-progress
                                                    break;
                                                case 'dibatalkan':
                                                    $badgeClass = 'badge-danger';
                                                    break;
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        {{ $pesananItem->tanggal_service_diharapkan ? \Carbon\Carbon::parse($pesananItem->tanggal_service_diharapkan)->translatedFormat('d M Y, H:i') : '-' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('teknisi.pesanan.show', $pesananItem->id) }}"
                                            class="btn btn-info btn-sm">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> Belum ada pesanan terbaru yang ditugaskan kepada Anda.
                </div>
            @endif
        </div>
    </div>
@endsection
