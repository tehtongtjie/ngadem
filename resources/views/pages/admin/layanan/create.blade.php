{{-- resources/views/pages/admin/layanan/create.blade.php --}}

@extends('layouts.Admin.app') {{-- Pastikan ini mengarah ke layout Admin Anda (SB Admin 2) --}}

@section('title', 'Tambah Layanan Baru')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Layanan Baru</h1>
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
    @if ($errors->any())
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
            <h6 class="m-0 font-weight-bold text-primary">Form Layanan Baru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
                {{-- Tambahkan enctype jika ada upload file --}}
                @csrf

                <div class="form-group">
                    <label for="nama_layanan">Nama Layanan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror" id="nama_layanan"
                        name="nama_layanan" value="{{ old('nama_layanan') }}" required>
                    @error('nama_layanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_dasar">Harga Dasar (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('harga_dasar') is-invalid @enderror" id="harga_dasar"
                        name="harga_dasar" value="{{ old('harga_dasar') }}" step="0.01" required>
                    @error('harga_dasar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                        required>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Optional: Jika ada upload gambar layanan --}}
                {{-- <div class="form-group">
                    <label for="gambar_layanan">Gambar Layanan (Opsional)</label>
                    <input type="file" class="form-control-file @error('gambar_layanan') is-invalid @enderror" id="gambar_layanan" name="gambar_layanan">
                    @error('gambar_layanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div> --}}

                <div class="mt-4 text-right">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Layanan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
