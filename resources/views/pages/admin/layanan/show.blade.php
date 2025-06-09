{{-- resources/views/pages/admin/layanan/show.blade.php --}}

@extends('layouts.Admin.app') {{-- Sesuaikan dengan layout admin SB Admin 2 Anda --}}

@section('title', 'Detail Layanan #' . $layanan->id)

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Layanan #{{ $layanan->id }}</h1>
        <a href="{{ route('admin.layanan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar Layanan
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
            <strong>Terjadi kesalahan:</strong>
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
            <h6 class="m-0 font-weight-bold text-primary">Informasi Layanan</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <p><strong>ID Layanan:</strong> {{ $layanan->id }}</p>
                    <p><strong>Nama Layanan:</strong> {{ $layanan->nama_layanan }}</p>
                    <p><strong>Deskripsi:</strong> {{ $layanan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    <p><strong>Harga Dasar:</strong> Rp{{ number_format($layanan->harga_dasar, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong>
                        @php
                            $statusText = ucfirst($layanan->status ?? 'Tidak Diketahui');
                            $badgeClass = 'badge-secondary';
                            switch (strtolower($layanan->status ?? '')) {
                                case 'aktif':
                                    $badgeClass = 'badge-success';
                                    break;
                                case 'nonaktif':
                                    $badgeClass = 'badge-danger';
                                    break;
                                default:
                                    $badgeClass = 'badge-dark';
                                    break;
                            }
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                    </p>
                    <p><strong>Dibuat Pada:</strong> {{ \Carbon\Carbon::parse($layanan->created_at)->format('d M Y H:i') }}
                    </p>
                    <p><strong>Diperbarui Pada:</strong>
                        {{ \Carbon\Carbon::parse($layanan->updated_at)->format('d M Y H:i') }}</p>
                </div>
            </div>

            <hr class="sidebar-divider my-4">

            <h5>Aksi</h5>
            <div class="mt-3">
                <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn btn-warning mr-2">
                    <i class="fas fa-edit"></i> Edit Layanan
                </a>
                {{-- Form untuk menghapus layanan (jika route destroy diaktifkan) --}}
                {{-- <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                        <i class="fas fa-trash"></i> Hapus Layanan
                    </button>
                </form> --}}
            </div>
        </div>
    </div>
@endsection
