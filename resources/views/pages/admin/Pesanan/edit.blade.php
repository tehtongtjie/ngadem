{{-- resources/views/pages/admin/pesanan/edit.blade.php --}}

@extends('layouts.admin.app') {{-- Pastikan ini mengarah ke layout admin SB Admin 2 Anda --}}

@section('title', 'Edit Pesanan #' . $pesanan->id)

@section('content')

    {{-- Header halaman --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pesanan #{{ $pesanan->id }}</h1>
        <a href="{{ route('admin.pesanan.show', $pesanan->id) }}"
            class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Detail
        </a>
    </div>

    {{-- Menampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Menampilkan pesan error validasi --}}
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
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Pesanan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Penting: Gunakan method PUT untuk update --}}

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <h5 class="text-primary mb-3">Informasi Pemesan</h5>
                        <label for="user_id">Nama Pelanggan <span class="text-danger">*</span></label>
                        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror"
                            required>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('user_id', $pesanan->user_id) == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <h5 class="text-primary mb-3">Teknisi Ditugaskan</h5>
                        <label for="teknisi_id">Pilih Teknisi</label>
                        <select name="teknisi_id" id="teknisi_id"
                            class="form-control @error('teknisi_id') is-invalid @enderror">
                            <option value="">-- Belum Ditugaskan --</option>
                            @foreach ($teknisis as $teknisi)
                                <option value="{{ $teknisi->id }}"
                                    {{ old('teknisi_id', $pesanan->teknisi_id) == $teknisi->id ? 'selected' : '' }}>
                                    {{ $teknisi->name }} ({{ $teknisi->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('teknisi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="sidebar-divider my-4">

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <h5 class="text-primary mb-3">Detail Layanan & Harga</h5>
                        <label for="service_id">Jenis Layanan <span class="text-danger">*</span></label>
                        <select name="service_id" id="service_id"
                            class="form-control @error('service_id') is-invalid @enderror" required>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ old('service_id', $pesanan->service_id) == $service->id ? 'selected' : '' }}>
                                    {{ $service->nama_layanan }}
                                    (Rp{{ number_format($service->harga_dasar, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="total_harga" class="mt-3">Total Harga <span class="text-danger">*</span></label>
                        <input type="number" name="total_harga" id="total_harga"
                            class="form-control @error('total_harga') is-invalid @enderror" required step="0.01"
                            value="{{ old('total_harga', $pesanan->total_harga) }}">
                        @error('total_harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <h5 class="text-primary mb-3">Jadwal & Status</h5>
                        <label for="tanggal_pesanan">Tanggal Pesanan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pesanan" id="tanggal_pesanan"
                            class="form-control @error('tanggal_pesanan') is-invalid @enderror" required
                            value="{{ old('tanggal_pesanan', \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('Y-m-d')) }}">
                        @error('tanggal_pesanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="tanggal_service_diharapkan" class="mt-3">Tanggal Servis Diharapkan <span
                                class="text-danger">*</span></label>
                        <input type="date" name="tanggal_service_diharapkan" id="tanggal_service_diharapkan"
                            class="form-control @error('tanggal_service_diharapkan') is-invalid @enderror" required
                            value="{{ old('tanggal_service_diharapkan', \Carbon\Carbon::parse($pesanan->tanggal_service_diharapkan)->format('Y-m-d')) }}">
                        @error('tanggal_service_diharapkan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="jam_service_diharapkan" class="mt-3">Jam Servis Diharapkan <span
                                class="text-danger">*</span></label>
                        <input type="time" name="jam_service_diharapkan" id="jam_service_diharapkan"
                            class="form-control @error('jam_service_diharapkan') is-invalid @enderror" required
                            step="1"
                            value="{{ old('jam_service_diharapkan', \Carbon\Carbon::parse($pesanan->jam_service_diharapkan)->format('H:i:s')) }}">
                        @error('jam_service_diharapkan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="status_order" class="mt-3">Status Pesanan <span class="text-danger">*</span></label>
                        <select name="status_order" id="status_order"
                            class="form-control @error('status_order') is-invalid @enderror" required>
                            <option value="pending"
                                {{ old('status_order', $pesanan->status_order) == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="diterima"
                                {{ old('status_order', $pesanan->status_order) == 'diterima' ? 'selected' : '' }}>
                                Diterima</option>
                            <option value="dalam_proses"
                                {{ old('status_order', $pesanan->status_order) == 'dalam_proses' ? 'selected' : '' }}>
                                Dalam Proses</option>
                            <option value="selesai"
                                {{ old('status_order', $pesanan->status_order) == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="dibatalkan"
                                {{ old('status_order', $pesanan->status_order) == 'dibatalkan' ? 'selected' : '' }}>
                                Dibatalkan</option>
                        </select>
                        @error('status_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="sidebar-divider my-4">

                <div class="form-group">
                    <h5 class="text-primary mb-3">Detail Tambahan</h5>
                    <label for="alamat_service">Alamat Servis <span class="text-danger">*</span></label>
                    <textarea name="alamat_service" id="alamat_service" rows="3"
                        class="form-control @error('alamat_service') is-invalid @enderror" required>{{ old('alamat_service', $pesanan->alamat_service) }}</textarea>
                    @error('alamat_service')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label for="deskripsi_masalah" class="mt-3">Deskripsi Masalah (Opsional)</label>
                    <textarea name="deskripsi_masalah" id="deskripsi_masalah" rows="3"
                        class="form-control @error('deskripsi_masalah') is-invalid @enderror">{{ old('deskripsi_masalah', $pesanan->deskripsi_masalah) }}</textarea>
                    @error('deskripsi_masalah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 text-right">
                    <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
