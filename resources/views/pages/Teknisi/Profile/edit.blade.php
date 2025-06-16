{{-- resources/views/pages/teknisi/profile/edit.blade.php --}}

@extends('layouts.Teknisi.app') {{-- Pastikan ini mengarah ke layout Admin Anda (SB Admin 2) --}}

@section('title', 'Edit Profil Teknisi')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Profil Saya</h1>
        <a href="{{ route('teknisi.profile.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Profil
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
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Profil</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('teknisi.profile.update', $teknisi->id) }}" method="POST">
                {{-- Penting: tambahkan enctype --}}
                @csrf
                @method('PUT')

                <div class="form-group text-center">
                    <label for="foto" class="d-block mb-3">Foto Profil Saat Ini:</label>
                    @if ($teknisi->foto)
                        <img id="profile-preview" src="{{ asset('storage/foto/' . $teknisi->foto) }}" alt="Foto Profil"
                            class="img-profile-preview rounded-circle mb-3 mx-auto border border-warning"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img id="profile-preview" src="{{ asset('template/img/undraw_profile.svg') }}" alt="Default Profile"
                            class="img-profile-preview rounded-circle mb-3 mx-auto border border-warning"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    @endif
                    <input type="file" class="form-control-file @error('foto') is-invalid @enderror d-none"
                        id="foto" name="foto" accept="image/*">
                    <label for="foto" class="btn btn-sm btn-outline-primary mt-2">Ubah Foto</label>
                    @error('foto')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror {{-- d-block agar pesan error tampil --}}
                </div>


                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap"
                        name="nama_lengkap" value="{{ old('nama_lengkap', $teknisi->nama_lengkap) }}" required>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                        required>{{ old('alamat', $teknisi->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor Telepon <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                        name="no_hp" value="{{ old('no_hp', $teknisi->no_hp) }}" required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @php
                    $keahlianList = ['Instalasi AC', 'Perbaikan AC', 'Cuci AC', 'Isi Freon', 'Bongkar Pasang'];
                @endphp

                <div class="form-group">
                    <label for="keahlian">Keahlian <span class="text-danger">*</span></label>
                    <select class="form-control @error('keahlian') is-invalid @enderror" id="keahlian" name="keahlian"
                        required>
                        <option value="">-- Pilih Keahlian --</option>
                        @foreach ($keahlianList as $item)
                            <option value="{{ $item }}"
                                {{ old('keahlian', $teknisi->keahlian) == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                    @error('keahlian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <h5 class="mt-4 text-primary">Ubah Password (Opsional)</h5>
                <p class="text-muted">Isi bagian ini hanya jika Anda ingin mengubah password Anda.</p>
                <div class="form-group">
                    <label for="current_password">Password Lama</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                        id="current_password" name="current_password">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="mt-4 text-right">
                    <a href="{{ route('teknisi.profile.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('foto').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('profile-preview').src = URL.createObjectURL(file);
            }
        });
    </script>
@endpush
