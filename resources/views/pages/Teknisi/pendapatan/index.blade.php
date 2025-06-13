@extends('layouts.teknisi.app')

@section('title', 'Pendapatan Teknisi')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pendapatan Teknisi</h1>
            <a href="{{ route('teknisi.orders.index') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-list mr-1"></i> Lihat Semua Pesanan
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="row">
            <!-- Total Pendapatan Teknisi -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 transition transform hover:-translate-y-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pendapatan Teknisi
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($pendapatanSummary['total_earnings'], 2, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wallet fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pesanan Selesai -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 transition transform hover:-translate-y-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Pesanan Selesai
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">
                                    {{ $pendapatanSummary['total_orders_completed'] }}</div>
                                <div class="progress mt-2" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ ($pendapatanSummary['total_orders_completed'] / ($pendapatanSummary['total_orders_completed'] + 1)) * 100 }}%"
                                        aria-valuenow="{{ $pendapatanSummary['total_orders_completed'] }}" aria-valuemin="0"
                                        aria-valuemax="{{ $pendapatanSummary['total_orders_completed'] + 1 }}"></div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Completed Orders -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Pesanan Selesai Terbaru</h6>
                <input type="text" id="dateRangeFilter" class="form-control form-control-sm w-auto"
                    placeholder="Pilih Rentang Tanggal" readonly>
            </div>
            <div class="card-body">
                @if ($completedOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Status</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Pendapatan</th>
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
                                        <td>
                                            {{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->translatedFormat('d M Y, H:i') }}
                                        </td>
                                        <td>Rp {{ number_format($order->earnings ?? 0, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('teknisi.orders.show', $order->id) }}"
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
                        <i class="fas fa-info-circle mr-1"></i> Belum ada pesanan yang selesai.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- DataTables and DateRangePicker JavaScript -->
@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1/daterangepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
                },
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "order": [
                    [4, "desc"]
                ], // Sort by Tanggal Selesai
                "columnDefs": [{
                        "orderable": false,
                        "targets": 6
                    } // Disable sorting on Aksi column
                ]
            });

            // Initialize DateRangePicker
            $('#dateRangeFilter').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Terapkan',
                    cancelLabel: 'Batal',
                    customRangeLabel: 'Kustom'
                },
                ranges: {
                    'Hari Ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')]
                }
            });

            // Filter by date range
            $('#dateRangeFilter').on('apply.daterangepicker', function(ev, picker) {
                table.column(4).search(picker.startDate.format('DD/MM/YYYY') + '-' + picker.endDate.format(
                    'DD/MM/YYYY')).draw();
            });

            $('#dateRangeFilter').on('cancel.daterangepicker', function() {
                $(this).val('');
                table.column(4).search('').draw();
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
