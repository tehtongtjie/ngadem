@extends('layouts.Admin.app') {{-- Pastikan Anda memiliki layout admin yang benar yang sudah mengimpor Bootstrap 4 dan SB Admin 2 assets --}}

@section('title', 'Detail Customer')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 style="font-weight: 700;" class="h3 mb-0 text-gray-800">Detail Customer</h1>
        <a href="{{ route('admin.customer.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar Pelanggan
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Customer</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th class="bg-light text-dark" style="width: 20%;">ID</th>
                            <td>{{ $customer->id }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Nama</th>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Email</th>
                            <td>{{ $customer->email }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Role</th>
                            <td>{{ ucfirst($customer->role) }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Terdaftar Sejak</th>
                            <td>{{ $customer->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Terakhir Diperbarui</th>
                            <td>{{ $customer->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4"> {{-- Margin top for spacing buttons --}}
                <a href="{{ route('admin.customer.edit', $customer->id) }}" class="btn btn-warning btn-icon-split mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span class="text">Edit Customer</span>
                </a>
                <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary btn-icon-split mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali ke Daftar</span>
                </a>

                <form action="{{ route('admin.customer.destroy', $customer->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-icon-split"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini?')">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Hapus Customer</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
