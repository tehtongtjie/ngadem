@extends('layouts.Admin.app') {{-- Pastikan Anda memiliki layout admin yang benar yang sudah mengimpor Bootstrap 4 dan SB Admin 2 assets --}}

@section('title', 'Edit Teknisi')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 style="font-weight: 700;" class="h3 mb-0 text-gray-800">Edit Teknisi</h1>
        <a href="{{ route('admin.teknisi.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar Teknisi
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Teknisi</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> Ada beberapa masalah dengan input Anda.
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('admin.teknisi.update', $teknisi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Teknisi:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $teknisi->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $teknisi->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password (kosongkan jika tidak ingin mengubah):</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        autocomplete="new-password">
                </div>

                <hr class="sidebar-divider my-4"> {{-- Separator for technician-specific fields --}}

                <h6 class="h5 mb-3 text-gray-800">Detail Teknisi</h6>

                <div class="form-group">
                    <label for="area_layanan">Area Layanan:</label>
                    <input type="text" class="form-control @error('area_layanan') is-invalid @enderror" id="area_layanan"
                        name="area_layanan" value="{{ old('area_layanan', $teknisi->detail->area_layanan ?? '') }}">
                    @error('area_layanan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="spesialisasi">Spesialisasi:</label>
                    <input type="text" class="form-control @error('spesialisasi') is-invalid @enderror" id="spesialisasi"
                        name="spesialisasi" value="{{ old('spesialisasi', $teknisi->detail->spesialisasi ?? '') }}">
                    @error('spesialisasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi_singkat">Deskripsi Singkat:</label>
                    <textarea class="form-control @error('deskripsi_singkat') is-invalid @enderror" id="deskripsi_singkat"
                        name="deskripsi_singkat" rows="3">{{ old('deskripsi_singkat', $teknisi->detail->deskripsi_singkat ?? '') }}</textarea>
                    @error('deskripsi_singkat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success btn-icon-split mt-4">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Update Teknisi</span>
                </button>
                <a href="{{ route('admin.teknisi.show', $teknisi->id) }}"
                    class="btn btn-secondary btn-icon-split mt-4 ml-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-times"></i>
                    </span>
                    <span class="text">Batal</span>
                </a>
            </form>
        </div>
    </div>
@endsection
