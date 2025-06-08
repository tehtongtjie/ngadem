@extends('layouts.Admin.app') {{-- Pastikan Anda memiliki layout admin yang benar yang sudah mengimpor Bootstrap 4 dan SB Admin 2 assets --}}

@section('title', 'Detail Pesanan')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 style="font-weight: 700;" class="h3 mb-0 text-gray-800">Detail Pesanan</h1>
        <a href="{{ route('admin.pesanan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar Pesanan
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th class="bg-light text-dark" style="width: 25%;">ID Pesanan</th>
                            <td>{{ $pesanan->id }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Pelanggan</th>
                            <td>{{ $pesanan->user->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Teknisi</th>
                            <td>{{ $pesanan->teknisi->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Layanan</th>
                            <td>{{ $pesanan->service->nama_layanan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Tanggal Pesanan</th>
                            <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Tanggal Service Diharapkan</th>
                            <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_service_diharapkan)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Jam Service Diharapkan</th>
                            <td>{{ $pesanan->jam_service_diharapkan }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Alamat Service</th>
                            <td>{{ $pesanan->alamat_service }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Deskripsi Masalah</th>
                            <td>{{ $pesanan->deskripsi_masalah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Status Order</th>
                            <td>
                                @php
                                    $statusText = ucfirst($pesanan->status_order ?? 'Tidak Diketahui');
                                    $badgeClass = 'badge-secondary'; // Default badge color
                                    switch (strtolower($pesanan->status_order ?? '')) {
                                        case 'selesai':
                                            $badgeClass = 'badge-success';
                                            break;
                                        case 'pending':
                                            $badgeClass = 'badge-secondary';
                                            break;
                                        case 'diterima':
                                            $badgeClass = 'badge-info';
                                            break;
                                        case 'dalam_proses':
                                            $badgeClass = 'badge-warning';
                                            break;
                                        case 'dibatalkan':
                                            $badgeClass = 'badge-danger';
                                            break;
                                        default:
                                            $badgeClass = 'badge-dark';
                                            break;
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Total Harga</th>
                            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Dibuat Pada</th>
                            <td>{{ $pesanan->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Terakhir Diperbarui</th>
                            <td>{{ $pesanan->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex"> {{-- Use d-flex for button alignment --}}
                <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}" class="btn btn-warning btn-icon-split mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span class="text">Edit Pesanan</span>
                </a>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-secondary btn-icon-split mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali ke Daftar</span>
                </a>
                {{-- Optional: Delete button for orders (consider carefully if direct deletion is desired) --}}
                {{-- <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-icon-split"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Hapus Pesanan</span>
                    </button>
                </form> --}}
            </div>
        </div>
    </div>
@endsection
