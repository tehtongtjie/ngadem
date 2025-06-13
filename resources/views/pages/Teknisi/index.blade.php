@extends('layouts.teknisi.app')

@section('title', 'Dashboard Teknisi')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Teknisi</h1>
            <a href="{{ route('teknisi.orders.index') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-list mr-1"></i> Lihat Semua Pesanan
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="row">
            <!-- Total Pesanan Diterima -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 transition transform hover:-translate-y-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pesanan Diterima
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $totalPesananDiterima }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pesanan Selesai -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 transition transform hover:-translate-y-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Pesanan Selesai
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $totalPesananSelesai }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pesanan Pending -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 transition transform hover:-translate-y-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pesanan Pending
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $totalPesananPending }}</div>
                                <div class="progress mt-2" style="height: 8px;">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ ($totalPesananPending / ($totalPesananDiterima ?: 1)) * 100 }}%"
                                        aria-valuenow="{{ $totalPesananPending }}" aria-valuemin="0"
                                        aria-valuemax="{{ $totalPesananDiterima ?: 1 }}"></div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Orders -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Pesanan Terbaru Anda</h6>
                <select id="statusFilter" class="form-control form-control-sm w-auto">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="diterima">Diterima</option>
                    <option value="dalam_proses">Dalam Proses</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
            </div>
            <div class="card-body">
                @if ($latestPesanan->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
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
                                @foreach ($latestPesanan as $index => $pesanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pesanan->user->name ?? '-' }}</td>
                                        <td>{{ $pesanan->service->nama_layanan ?? '-' }}</td>
                                        <td>
                                            @php
                                                $statusText = ucfirst($pesanan->status_order ?? 'Tidak Diketahui');
                                                $badgeClass = 'badge-secondary';
                                                switch (strtolower($pesanan->status_order ?? '')) {
                                                    case 'selesai':
                                                        $badgeClass = 'badge-success';
                                                        break;
                                                    case 'pending':
                                                        $badgeClass = 'badge-warning';
                                                        break;
                                                    case 'diterima':
                                                        $badgeClass = 'badge-info';
                                                        break;
                                                    case 'dalam_proses':
                                                        $badgeClass = 'badge-primary';
                                                        break;
                                                    case 'dibatalkan':
                                                        $badgeClass = 'badge-danger';
                                                        break;
                                                }
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($pesanan->tanggal_service_diharapkan)->translatedFormat('d M Y, H:i') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('teknisi.orders.show', $pesanan->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye mr-1"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle mr-1"></i> Belum ada pesanan terbaru yang ditugaskan kepada Anda.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- DataTables JavaScript -->
@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
                },
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "order": [
                    [4, "desc"]
                ], // Sort by Tanggal Diharapkan
                "columnDefs": [{
                        "orderable": false,
                        "targets": 5
                    } // Disable sorting on Aksi column
                ]
            });

            // Filter by status
            $('#statusFilter').on('change', function() {
                table.column(3).search(this.value).draw();
            });

            // Loading spinner
            $('#dataTable').on('processing.dt', function(e, settings, processing) {
                if (processing) {
                    $(this).closest('.table-responsive').append(
                        '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                        );
                } else {
                    $(this).closest('.table-responsive').find('.spinner-border').remove();
                }
            });
        });
    </script>
    <style>
        .transition {
            transition: all 0.3s ease;
        }

        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .hover\:-translate-y-1:hover {
            transform: translateY(-4px);
        }

        .spinner-border {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 10;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection
@endsection
