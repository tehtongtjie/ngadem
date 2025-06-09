@extends('layouts.teknisi.app')

@section('title', 'Pendapatan Teknisi')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">Pendapatan Teknisi</h1>

        <div class="row">
            <!-- Total Pendapatan Teknisi -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pendapatan Teknisi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($pendapatanSummary['total_earnings'], 2) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wallet fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan Perusahaan -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Pendapatan Perusahaan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($pendapatanSummary['total_company_earnings'], 2) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pesanan Selesai -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pesanan Selesai
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $pendapatanSummary['total_orders_completed'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                @if ($completedOrders->count() > 0)
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
                                @foreach ($completedOrders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->user->name ?? '-' }}</td>
                                        <td>{{ $order->service->nama_layanan ?? '-' }}</td>
                                        <td>
                                            <span class="badge badge-success">{{ ucfirst($order->status_order) }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->translatedFormat('d M Y, H:i') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('teknisi.orders.show', $order->id) }}"
                                                class="btn btn-info btn-sm">Lihat</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> Belum ada pesanan yang selesai.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
