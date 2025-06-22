@extends('layouts.customer.app')

@section('title', 'Detail Pembayaran #' . $payment->id)

@section('content')

    {{-- ===================== SPACER UNTUK HEADER ===================== --}}
    <div id="header-spacer" class="h-10 md:h-20"></div>

    {{-- ===================== MAIN CONTAINER ===================== --}}
    <main class="container mx-auto px-4 py-8 md:py-12 lg:py-16">

        {{-- ---------- WRAPPER BOX ---------- --}}
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            {{-- ---------- HEADER TITLE ---------- --}}
            <header class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 md:p-8">
                <h1 class="text-2xl md:text-3xl font-bold text-center">
                    Detail Pembayaran <span class="font-extrabold">#{{ $payment->id }}</span>
                </h1>
            </header>

            {{-- ---------- ISI KONTEN ---------- --}}
            <div class="p-6 md:p-8 lg:p-10 space-y-8">

                {{-- ---------- RINCIAN PEMBAYARAN ---------- --}}
                <section class="group">
                    <h2
                        class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center group-hover:translate-x-1 transition-transform duration-300">
                        <i class="fas fa-money-check-alt text-yellow-500 mr-3"></i> Rincian Pembayaran
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-lg">
                        <div class="space-y-2">
                            <p><span class="font-medium text-gray-600">ID Pembayaran:</span> {{ $payment->id }}</p>
                            <p><span class="font-medium text-gray-600">ID Pesanan Terkait:</span> {{ $payment->order_id }}
                            </p>
                            <p><span class="font-medium text-gray-600">Tanggal Pembayaran:</span>
                                {{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->isoFormat('D MMMM YYYY, HH:mm') }}
                            </p>
                        </div>
                        <div class="space-y-2">
                            <p><span class="font-medium text-gray-600">Jumlah Dibayar:</span>
                                Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</p>
                            <p><span class="font-medium text-gray-600">Metode Pembayaran:</span>
                                {{ ucfirst(str_replace('_', ' ', $payment->metode_pembayaran)) }}</p>
                            <p><span class="font-medium text-gray-600">Status Pembayaran:</span>
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-medium transition-all duration-300
                                    @if ($payment->status_pembayaran === 'pending') bg-yellow-100 text-yellow-700 hover:bg-yellow-200
                                    @elseif ($payment->status_pembayaran === 'berhasil') bg-green-100 text-green-700 hover:bg-green-200
                                    @elseif ($payment->status_pembayaran === 'gagal') bg-red-100 text-red-700 hover:bg-red-200
                                    @else bg-gray-100 text-gray-700 hover:bg-gray-200 @endif">
                                    {{ ucfirst($payment->status_pembayaran) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </section>

                {{-- ---------- DETAIL PESANAN TERKAIT ---------- --}}
                @if ($payment->order)
                    <section class="group">
                        <h2
                            class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center group-hover:translate-x-1 transition-transform duration-300">
                            <i class="fas fa-file-invoice text-yellow-500 mr-3"></i> Detail Pesanan Terkait
                        </h2>
                        <div class="bg-gray-50 p-6 rounded-lg space-y-2">
                            <p><span class="font-medium text-gray-600">Layanan:</span>
                                {{ $payment->order->service->nama_layanan ?? 'N/A' }}</p>
                            <p><span class="font-medium text-gray-600">Tanggal Servis:</span>
                                {{ \Carbon\Carbon::parse($payment->order->tanggal_service_diharapkan)->isoFormat('D MMMM YYYY') }}
                            </p>
                            <p><span class="font-medium text-gray-600">Status Pesanan:</span>
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-medium transition-all duration-300
                                    @if ($payment->order->status_order === 'pending') bg-yellow-100 text-yellow-700 hover:bg-yellow-200
                                    @elseif ($payment->order->status_order === 'diterima') bg-blue-100 text-blue-700 hover:bg-blue-200
                                    @elseif ($payment->order->status_order === 'dalam_proses') bg-purple-100 text-purple-700 hover:bg-purple-200
                                    @elseif ($payment->order->status_order === 'selesai') bg-green-100 text-green-700 hover:bg-green-200
                                    @elseif ($payment->order->status_order === 'dibatalkan') bg-red-100 text-red-700 hover:bg-red-200
                                    @else bg-gray-100 text-gray-700 hover:bg-gray-200 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $payment->order->status_order)) }}
                                </span>
                            </p>
                            <p><span class="font-medium text-gray-600">Alamat Servis:</span>
                                {{ $payment->order->alamat_service }}</p>
                            <p><span class="font-medium text-gray-600">Deskripsi Masalah:</span>
                                {{ $payment->order->deskripsi_masalah ?? 'Tidak ada.' }}</p>
                            <a href="{{ route('customer.orders.show', $payment->order->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white font-semibold rounded-full hover:bg-yellow-600 transition duration-300 transform hover:scale-105 mt-4">
                                <i class="fas fa-eye mr-2"></i> Lihat Detail Pesanan
                            </a>
                        </div>
                    </section>
                @else
                    {{-- ---------- JIKA PESANAN TIDAK DITEMUKAN ---------- --}}
                    <section class="group">
                        <h2
                            class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center group-hover:translate-x-1 transition-transform duration-300">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i> Pesanan Tidak Ditemukan
                        </h2>
                        <div class="bg-gray-50 p-6 rounded-lg text-gray-600">
                            <p>Detail pesanan terkait tidak dapat dimuat.</p>
                        </div>
                    </section>
                @endif

                {{-- ---------- BUKTI PEMBAYARAN ---------- --}}
                <section class="group">
                    <h2
                        class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center group-hover:translate-x-1 transition-transform duration-300">
                        <i class="fas fa-receipt text-yellow-500 mr-3"></i> Bukti Pembayaran
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        @if ($payment->bukti_pembayaran)
                            <div class="relative max-w-xs mx-auto">
                                <img src="{{ asset('storage/' . $payment->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                                    class="w-full h-auto border border-gray-200 rounded-lg shadow-md cursor-pointer hover:opacity-90 transition-opacity duration-300"
                                    id="payment-proof">
                                <p class="text-sm text-gray-500 mt-2 text-center">Klik gambar untuk memperbesar.</p>
                            </div>
                        @else
                            <div class="text-gray-600">
                                <p class="italic">Belum ada bukti pembayaran diunggah.</p>
                                @if ($payment->status_pembayaran === 'pending' || $payment->status_pembayaran === 'gagal')
                                    <a href="{{ route('customer.payments.upload', $payment->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-full hover:bg-blue-600 transition duration-300 transform hover:scale-105 mt-4">
                                        <i class="fas fa-upload mr-2"></i> Unggah Bukti Pembayaran
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </section>

                {{-- ---------- TOMBOL AKSI BAWAH ---------- --}}
                <div class="flex justify-center mt-10 space-x-4">
                    @if ($payment->status_pembayaran === 'berhasil')
                        <a href="{{ route('customer.payments.download', $payment->id) }}"
                            class="inline-flex items-center px-6 py-3 bg-green-500 text-white font-semibold rounded-full hover:bg-green-600 transition duration-300 transform hover:scale-105">
                            <i class="fas fa-download mr-2"></i> Unduh Bukti
                        </a>
                    @endif
                    <a href="{{ route('customer.payments.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-full hover:bg-gray-300 transition duration-300 transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Riwayat Pembayaran
                    </a>
                </div>

            </div>
        </div>
    </main>

    {{-- ===================== SCRIPT TAMBAHAN ===================== --}}
    @push('scripts')
        <script src="{{ asset('js/show-payment-customer.js') }}"></script>
    @endpush

@endsection
