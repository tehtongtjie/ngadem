@extends('layouts.Teknisi.app')

@section('title', 'Profil Teknisi')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profil Saya</h1>
        <a href="{{ route('teknisi.profile.edit', $teknisi->id) }}"
            class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
            <i class="fas fa-edit fa-sm text-white-50"></i> Edit Profil
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Notifikasi error --}}
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
            <h6 class="m-0 font-weight-bold text-primary">Informasi Profil</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    @if ($teknisi->foto)
                        <img src="{{ asset('storage/foto/' . $teknisi->foto) }}" alt="Foto Profil"
                            class="img-profile-preview rounded-circle mb-3 border border-warning"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="{{ asset('template/img/undraw_profile.svg') }}" alt="Default Profile"
                            class="img-profile-preview rounded-circle mb-3 border border-warning"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    @endif
                </div>

                <div class="col-lg-12">
                    <p><strong>Nama Lengkap:</strong> {{ $teknisi->nama_lengkap ?? ($teknisi->user->name ?? 'N/A') }}</p>
                    <p><strong>Email:</strong> {{ $teknisi->user->email ?? 'N/A' }}</p>
                    <p><strong>Nomor Telepon:</strong> {{ $teknisi->no_hp ?? 'N/A' }}</p>
                    <p><strong>Alamat:</strong> {{ $teknisi->alamat ?? 'N/A' }}</p>
                    <p><strong>Keahlian:</strong> {{ $teknisi->keahlian ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
