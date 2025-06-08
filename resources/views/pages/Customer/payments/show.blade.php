{{-- resources/views/pages/customer/payments/show.blade.php --}}

@extends('layouts.customer.app')

@section('title', 'Detail Pembayaran #' . $payment->id)

@section('content')
    {{-- Spacer untuk memberikan jarak dari navbar yang mungkin fixed atau sticky --}}
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="max-w-3xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-lg border border-gray-100">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">
                Detail Pembayaran <span class="text-yellow-600">#{{ $payment->id }}</span>
            </h1>

            <div class="space-y-6">
                {{-- Informasi Pembayaran --}}
                <div class="border-b pb-4">
                    <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-money-check-alt text-yellow-500 mr-2"></i> Rincian Pembayaran
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                        <div>
                            <p><span class="font-semibold">ID Pembayaran:</span> {{ $payment->id }}</p>
                            <p><span class="font-semibold">ID Pesanan Terkait:</span> {{ $payment->order_id }}</p>
                            <p><span class="font-semibold">Tanggal Pembayaran:</span>
                                {{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->isoFormat('D MMMM YYYY, HH:mm') }}
                            </p>
                        </div>
                        <div>
                            <p><span class="font-semibold">Jumlah Dibayar:</span>
                                Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</p>
                            <p><span class="font-semibold">Metode Pembayaran:</span>
                                {{ ucfirst($payment->metode_pembayaran) }}</p>
                            <p><span class="font-semibold">Status Pembayaran:</span>
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if ($payment->status_pembayaran === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif ($payment->status_pembayaran === 'berhasil') bg-green-100 text-green-800
                                    @elseif ($payment->status_pembayaran === 'gagal') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($payment->status_pembayaran) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Detail Pesanan Terkait (jika relasi dimuat) --}}
                @if ($payment->order)
                    <div class="border-b pb-4">
                        <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-file-invoice text-yellow-500 mr-2"></i> Detail Pesanan Terkait
                        </h2>
                        <p><span class="font-semibold">Layanan:</span> {{ $payment->order->service->nama_layanan ?? 'N/A' }}
                        </p>
                        <p><span class="font-semibold">Tanggal Servis Diharapkan:</span>
                            {{ \Carbon\Carbon::parse($payment->order->tanggal_service_diharapkan)->isoFormat('D MMMM YYYY') }}
                        </p>
                        <p><span class="font-semibold">Status Pesanan:</span>
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold
                                @if ($payment->order->status_order === 'pending') bg-yellow-100 text-yellow-800
                                @elseif ($payment->order->status_order === 'diterima') bg-blue-100 text-blue-800
                                @elseif ($payment->order->status_order === 'dalam_proses') bg-purple-100 text-purple-800
                                @elseif ($payment->order->status_order === 'selesai') bg-green-100 text-green-800
                                @elseif ($payment->order->status_order === 'dibatalkan') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $payment->order->status_order)) }}
                            </span>
                        </p>
                        <p><span class="font-semibold">Alamat Servis:</span> {{ $payment->order->alamat_service }}</p>
                        <p><span class="font-semibold">Deskripsi Masalah:</span>
                            {{ $payment->order->deskripsi_masalah ?? 'Tidak ada.' }}</p>
                    </div>
                @else
                    <div class="border-b pb-4 text-gray-600">
                        <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i> Pesanan Tidak Ditemukan
                        </h2>
                        <p>Detail pesanan terkait tidak dapat dimuat.</p>
                    </div>
                @endif

                {{-- Bukti Pembayaran (jika ada) --}}
                @if ($payment->bukti_pembayaran)
                    <div>
                        <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-receipt text-yellow-500 mr-2"></i> Bukti Pembayaran
                        </h2>
                        <img src="{{ asset('storage/' . $payment->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                            class="max-w-xs h-auto border rounded-lg shadow-md">
                        <p class="text-sm text-gray-500 mt-2">Klik gambar untuk melihat lebih jelas.</p>
                    </div>
                @else
                    <div class="text-gray-600">
                        <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-file-invoice-slash text-gray-500 mr-2"></i> Bukti Pembayaran
                        </h2>
                        <p>Belum ada bukti pembayaran diunggah.</p>
                    </div>
                @endif
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-8 text-center">
                <a href="{{ route('customer.payment.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-full
                           hover:bg-gray-300 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Riwayat Pembayaran
                </a>
            </div>
        </div>
    </main>
@endsection
