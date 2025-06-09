{{-- resources/views/pages/teknisi/orders/upload_report.blade.php --}}

@extends('layouts.Admin.app') {{-- Sesuaikan dengan layout Admin Anda (SB Admin 2) --}}

@section('title', 'Unggah Laporan Pesanan #' . $order->id)

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Unggah Laporan Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('teknisi.orders.show', $order->id) }}"
            class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Detail
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
            <i class="fas fa-times-circle mr-2"></i> {{ session('error') }}
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
            <h6 class="m-0 font-weight-bold text-primary">Form Unggah Laporan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('teknisi.orders.store_report', $order->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="report_file">File Laporan (PDF, DOCX, JPG, PNG)</label>
                    <input type="file" class="form-control-file @error('report_file') is-invalid @enderror"
                        id="report_file" name="report_file" required>
                    <small class="form-text text-muted">Ukuran maksimal 5MB. Format yang didukung: PDF, DOCX, JPG,
                        PNG.</small>
                    @error('report_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Optional: Jika ingin ada kolom teks untuk laporan juga --}}
                <div class="form-group">
                    <label for="report_text">Catatan Laporan Tambahan (Opsional)</label>
                    <textarea class="form-control @error('report_text') is-invalid @enderror" id="report_text" name="report_text"
                        rows="5">{{ old('report_text') }}</textarea>
                    @error('report_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Unggah Laporan
                    </button>
                    <a href="{{ route('teknisi.orders.show', $order->id) }}" class="btn btn-secondary ml-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
