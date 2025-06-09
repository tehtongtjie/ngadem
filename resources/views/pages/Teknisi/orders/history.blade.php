{{-- resources/views/pages/teknisi/orders/history.blade.php --}}

@extends('layouts.teknisi.app')

@section('title', 'Riwayat Pesanan Teknisi')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pesanan</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($orders->count() > 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Pesanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Tgl. Servis</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $index }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                                    <td>{{ $order->service->nama_layanan ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->format('d M Y') }}
                                    </td>
                                    <td>
                                        @php
                                            $statusText = ucfirst(str_replace('_', ' ', $order->status_order));
                                            $badgeClass = 'badge-secondary';
                                            switch (strtolower($order->status_order)) {
                                                case 'selesai':
                                                    $badgeClass = 'badge-success';
                                                    break;
                                                case 'pending':
                                                    $badgeClass = 'badge-info';
                                                    break;
                                                case 'diterima':
                                                    $badgeClass = 'badge-primary';
                                                    break;
                                                case 'dalam_proses':
                                                    $badgeClass = 'badge-warning';
                                                    break;
                                                case 'dibatalkan':
                                                    $badgeClass = 'badge-danger';
                                                    break;
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('teknisi.orders.show', $order->id) }}" class="btn btn-info btn-sm"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- Jika ada aksi lain untuk riwayat, tambahkan di sini --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle"></i> Belum ada riwayat pesanan.
        </div>
    @endif
@endsection
