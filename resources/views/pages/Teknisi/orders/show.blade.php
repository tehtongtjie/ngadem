{{-- resources/views/pages/teknisi/orders/show.blade.php --}}

@extends('layouts.Teknisi.app') {{-- Pastikan ini mengarah ke layout Admin Anda (SB Admin 2) --}}

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('teknisi.orders.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
        </a>
    </div>

    {{-- Pesan sukses atau error dari session --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-times-circle mr-2"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>ID Pesanan:</strong> {{ $order->id }}</p>
                    <p><strong>Pelanggan:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                    <p><strong>Email Pelanggan:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                    <p><strong>Nomor Telepon:</strong> {{ $order->user->phone ?? 'N/A' }}</p> {{-- Asumsi kolom phone ada di user --}}
                    <p><strong>Teknisi Ditugaskan:</strong> {{ $order->teknisi->name ?? 'Belum Ditugaskan' }}</p>
                    <p><strong>Status Pesanan:</strong>
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
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Layanan:</strong> {{ $order->service->nama_layanan ?? 'N/A' }}</p>
                    <p><strong>Deskripsi Layanan:</strong> {{ $order->service->deskripsi ?? 'N/A' }}</p>
                    <p><strong>Total Harga:</strong> Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                    <p><strong>Tanggal Pesanan:</strong>
                        {{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('d M Y H:i') }}</p>
                    <p><strong>Tgl. Servis Diharapkan:</strong>
                        {{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->format('d M Y') }}</p>
                    <p><strong>Jam Servis Diharapkan:</strong>
                        {{ \Carbon\Carbon::parse($order->jam_service_diharapkan)->format('H:i') }}</p>
                </div>
            </div>

            <hr class="sidebar-divider my-4">

            <h5>Alamat & Deskripsi Masalah</h5>
            <div class="row mb-3">
                <div class="col-md-12">
                    <p><strong>Alamat Servis:</strong> {{ $order->alamat_service }}</p>
                    <p><strong>Deskripsi Masalah:</strong>
                        {{ $order->deskripsi_masalah ?? 'Tidak ada deskripsi tambahan.' }}</p>
                </div>
            </div>

            <hr class="sidebar-divider my-4">

            <h5>Informasi Pembayaran</h5>
            @if ($order->payments->isNotEmpty())
                @php
                    $payment = $order->payments->first(); // Ambil pembayaran pertama (asumsi 1 order = 1 pembayaran)
                    $paymentStatusText = ucfirst($payment->status_pembayaran ?? 'Tidak Diketahui');
                    $paymentBadgeClass = 'badge-secondary';
                    switch (strtolower($payment->status_pembayaran ?? '')) {
                        case 'berhasil':
                            $paymentBadgeClass = 'badge-success';
                            break;
                        case 'pending':
                            $paymentBadgeClass = 'badge-warning';
                            break;
                        case 'gagal':
                            $paymentBadgeClass = 'badge-danger';
                            break;
                    }
                @endphp
                <p><strong>ID Pembayaran:</strong> {{ $payment->id }}</p>
                <p><strong>Jumlah Bayar:</strong> Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($payment->metode_pembayaran) }}</p>
                <p><strong>Status Pembayaran:</strong> <span
                        class="badge {{ $paymentBadgeClass }}">{{ $paymentStatusText }}</span></p>
                <p><strong>Tanggal Pembayaran:</strong>
                    {{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->format('d M Y H:i') }}</p>

                @if ($payment->bukti_pembayaran)
                    <div class="mt-3">
                        <h6>Bukti Pembayaran:</h6>
                        <a href="{{ asset('storage/' . $payment->bukti_pembayaran) }}" target="_blank">
                            <img src="{{ asset('storage/' . $payment->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                                class="img-fluid rounded shadow-sm" style="max-width: 200px;">
                        </a>
                        <p class="text-muted mt-1">Klik gambar untuk melihat ukuran penuh.</p>
                    </div>
                @else
                    <div class="alert alert-info mt-3">Belum ada bukti pembayaran diunggah oleh pelanggan.</div>
                @endif
            @else
                <div class="alert alert-warning">Belum ada informasi pembayaran untuk pesanan ini.</div>
            @endif

            <hr class="sidebar-divider my-4">

            <h5>Aksi untuk Teknisi</h5>
            <div class="mt-3">
                {{-- Tombol Aksi berdasarkan status pesanan --}}
                @if ($order->status_order === 'pending')
                    {{-- Ini mungkin tidak relevan jika teknisi hanya melihat pesanan yang sudah 'diterima' --}}
                    <form action="{{ route('teknisi.orders.update', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_order" value="diterima">
                        <button type="submit" class="btn btn-success mr-2" onclick="return confirm('Terima pesanan ini?')">
                            <i class="fas fa-check"></i> Terima Pesanan
                        </button>
                    </form>
                    <form action="{{ route('teknisi.orders.update', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_order" value="dibatalkan">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak pesanan ini?')">
                            <i class="fas fa-times"></i> Tolak Pesanan
                        </button>
                    </form>
                @elseif ($order->status_order === 'diterima')
                    <form action="{{ route('teknisi.orders.update', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_order" value="dalam_proses">
                        <button type="submit" class="btn btn-warning mr-2"
                            onclick="return confirm('Mulai proses pengerjaan pesanan ini?')">
                            <i class="fas fa-play"></i> Mulai Pekerjaan
                        </button>
                    </form>
                @elseif ($order->status_order === 'dalam_proses')
                    <form action="{{ route('teknisi.orders.update', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_order" value="selesai">
                        <button type="submit" class="btn btn-success mr-2"
                            onclick="return confirm('Selesaikan pesanan ini?')">
                            <i class="fas fa-check-double"></i> Selesaikan Pekerjaan
                        </button>
                    </form>
                @elseif ($order->status_order === 'selesai')
                    <p class="text-success font-weight-bold">Pesanan ini sudah selesai.</p>
                    {{-- Opsional: Tombol untuk melihat atau mengunggah laporan teknis --}}
                    <a href="{{ route('teknisi.orders.upload_report', $order->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-upload"></i> Unggah Laporan
                    </a>
                @elseif ($order->status_order === 'dibatalkan')
                    <p class="text-danger font-weight-bold">Pesanan ini telah dibatalkan.</p>
                @endif
            </div>

        </div>
    </div>
@endsection
