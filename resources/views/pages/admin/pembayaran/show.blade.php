@extends('layouts.Admin.app') {{-- Sesuaikan dengan layout admin SB Admin 2 Anda --}}

@section('title', 'Detail Pembayaran #' . $pembayaran->id)

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembayaran #{{ $pembayaran->id }}</h1>
        <a href="{{ route('admin.pembayaran.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
        </a>
    </div>

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
            <strong>Terjadi kesalahan input:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>ID Pembayaran:</strong> {{ $pembayaran->id }}</p>
                    <p><strong>ID Pesanan:</strong> {{ $pembayaran->order_id }}</p>
                    <p><strong>Pelanggan:</strong> {{ $pembayaran->order->user->name ?? 'N/A' }}</p>
                    <p><strong>Layanan:</strong> {{ $pembayaran->order->service->nama_layanan ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Jumlah Bayar:</strong> Rp{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</p>
                    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($pembayaran->metode_pembayaran) }}</p>
                    <p><strong>Status Pembayaran:</strong>
                        @php
                            $statusText = ucfirst($pembayaran->status_pembayaran ?? 'Tidak Diketahui');
                            $badgeClass = 'badge-secondary';
                            switch (strtolower($pembayaran->status_pembayaran ?? '')) {
                                case 'berhasil':
                                    $badgeClass = 'badge-success';
                                    break;
                                case 'pending':
                                    $badgeClass = 'badge-warning';
                                    break;
                                case 'gagal':
                                    $badgeClass = 'badge-danger';
                                    break;
                                default:
                                    $badgeClass = 'badge-dark';
                                    break;
                            }
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                    </p>
                    <p><strong>Tanggal Pembayaran:</strong>
                        {{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d M Y H:i') }}</p>
                </div>
            </div>

            <hr class="sidebar-divider my-4">

            <h5>Bukti Pembayaran</h5>
            @if ($pembayaran->bukti_pembayaran)
                <div class="mt-3">
                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                            class="img-fluid rounded shadow-sm" style="max-width: 300px;">
                    </a>
                    <p class="text-muted mt-2">Klik gambar untuk melihat ukuran penuh.</p>
                </div>
            @else
                <div class="alert alert-light mt-3" role="alert">
                    Belum ada bukti pembayaran diunggah.
                </div>
            @endif

            <hr class="sidebar-divider my-4">

            <h5>Aksi Admin</h5>
            <div class="mt-3">
                @if ($pembayaran->status_pembayaran === 'pending' || $pembayaran->status_pembayaran === 'gagal')
                    <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_pembayaran" value="berhasil">
                        <button type="submit" class="btn btn-success mr-2"
                            onclick="return confirm('Konfirmasi pembayaran ini berhasil?')">
                            <i class="fas fa-check"></i> Konfirmasi Berhasil
                        </button>
                    </form>
                    <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_pembayaran" value="gagal">
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Konfirmasi pembayaran ini gagal? Ini akan mengembalikan status menjadi gagal.')">
                            <i class="fas fa-times"></i> Set Gagal
                        </button>
                    </form>
                @elseif ($pembayaran->status_pembayaran === 'berhasil')
                    <p class="text-success font-weight-bold">Pembayaran ini sudah berhasil dikonfirmasi.</p>
                    <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_pembayaran" value="pending">
                        <button type="submit" class="btn btn-warning"
                            onclick="return confirm('Set status pembayaran kembali ke Pending? Hanya lakukan ini jika ada kesalahan.')">
                            <i class="fas fa-undo"></i> Set Pending
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
