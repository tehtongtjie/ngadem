@extends('layouts.Admin.app') {{-- Pastikan Anda memiliki layout admin yang benar yang sudah mengimpor Bootstrap 4 dan SB Admin 2 assets --}}

@section('title', 'Daftar Pembayaran')

@section('content')

    <div style="font-weight: 700;" class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 style="font-weight: 700;" class="h3 mb-0 text-gray-800">Daftar Pembayaran</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order ID</th>
                            <th>Metode Pembayaran</th>
                            <th>Jumlah Bayar</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    {{-- Optional: Add a <tfoot> if you're using DataTables JS --}}
                    {{--
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Order ID</th>
                            <th>Metode Pembayaran</th>
                            <th>Jumlah Bayar</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    --}}
                    <tbody>
                        @forelse ($pembayarans as $pembayaran)
                            <tr>
                                <td>{{ $pembayaran->id }}</td>
                                <td>{{ $pembayaran->order_id }}</td>
                                <td>{{ $pembayaran->metode_pembayaran }}</td>
                                <td>Rp {{ number_format($pembayaran->jumlah_bayar, 2, ',', '.') }}</td>
                                <td>
                                    @php
                                        $statusText = ucfirst($pembayaran->status_pembayaran ?? 'Tidak Diketahui');
                                        $badgeClass = 'badge-secondary'; // Default badge color
                                        switch (strtolower($pembayaran->status_pembayaran ?? '')) {
                                            case 'completed':
                                            case 'lunas':
                                                $badgeClass = 'badge-success';
                                                break;
                                            case 'pending':
                                                $badgeClass = 'badge-warning';
                                                break;
                                            case 'failed':
                                            case 'gagal':
                                                $badgeClass = 'badge-danger';
                                                break;
                                            case 'refunded':
                                            case 'dikembalikan':
                                                $badgeClass = 'badge-info';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                </td>
                                <td>
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $pembayaran->tanggal_pembayaran->format('d M Y H:i') }}
                                    </p>
                                </td>
                                <td>
                                    <a href="{{ route('admin.pembayaran.show', $pembayaran->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <form action="{{ route('admin.pembayaran.destroy', $pembayaran->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
