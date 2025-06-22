@extends('layouts.customer.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
    <div id="header-spacer" class="h-16 md:h-20"></div>

    <main class="container mx-auto px-4 py-8 md:py-16">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            {{-- ===================== HEADER ===================== --}}
            <header class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 md:p-8">
                <h1 class="text-2xl md:text-3xl font-bold text-center">
                    Detail Pesanan <span class="font-extrabold">#{{ $order->id }}</span>
                </h1>
            </header>

            <div class="p-6 md:p-8 space-y-8">

                {{-- ===================== INFORMASI UMUM ===================== --}}
                <section class="group">
                    <h2
                        class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                        <i class="fas fa-clipboard-list text-yellow-500 mr-3"></i> Informasi Umum
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-lg">
                        <div class="space-y-2">
                            <p><span class="font-medium text-gray-600">Tanggal Pesanan:</span>
                                {{ \Carbon\Carbon::parse($order->tanggal_pesanan)->isoFormat('D MMMM YYYY, HH:mm') }}</p>
                            <p><span class="font-medium text-gray-600">Tanggal Servis:</span>
                                {{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->isoFormat('D MMMM YYYY') }}
                            </p>
                            <p><span class="font-medium text-gray-600">Jam Servis:</span>
                                {{ \Carbon\Carbon::parse($order->jam_service_diharapkan)->format('H:i') }}</p>
                        </div>
                        <div class="space-y-2">
                            <p><span class="font-medium text-gray-600">Total Harga:</span>
                                Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                            <p><span class="font-medium text-gray-600">Status:</span>
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-medium transition-all duration-300
                                    @if ($order->status_order === 'pending') bg-yellow-100 text-yellow-700 hover:bg-yellow-200
                                    @elseif ($order->status_order === 'diterima') bg-blue-100 text-blue-700 hover:bg-blue-200
                                    @elseif ($order->status_order === 'dalam_proses') bg-purple-100 text-purple-700 hover:bg-purple-200
                                    @elseif ($order->status_order === 'selesai') bg-green-100 text-green-700 hover:bg-green-200
                                    @elseif ($order->status_order === 'dibatalkan') bg-red-100 text-red-700 hover:bg-red-200
                                    @else bg-gray-100 text-gray-700 hover:bg-gray-200 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $order->status_order)) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </section>

                {{-- ===================== DETAIL LAYANAN ===================== --}}
                <section class="group">
                    <h2
                        class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                        <i class="fas fa-tools text-yellow-500 mr-3"></i> Detail Layanan
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <p class="mb-2"><span class="font-medium text-gray-600">Nama Layanan:</span>
                            {{ $order->service->nama_layanan ?? 'N/A' }}</p>
                        <p class="text-gray-600"><span class="font-medium text-gray-600">Deskripsi:</span>
                            {{ $order->service->deskripsi ?? 'N/A' }}</p>
                    </div>
                </section>

                {{-- ===================== INFORMASI ALAMAT ===================== --}}
                <section class="group">
                    <h2
                        class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                        <i class="fas fa-map-marker-alt text-yellow-500 mr-3"></i> Alamat Servis
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg flex items-start">
                        <i class="fas fa-map-pin text-gray-400 mr-3 mt-1"></i>
                        <p class="text-gray-700 flex-1">{{ $order->alamat_service }}</p>
                    </div>
                </section>

                {{-- ===================== DESKRIPSI MASALAH ===================== --}}
                <section class="group">
                    <h2
                        class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                        <i class="fas fa-comment-alt text-yellow-500 mr-3"></i> Deskripsi Masalah
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <p class="text-gray-700">{{ $order->deskripsi_masalah ?? 'Tidak ada deskripsi tambahan.' }}</p>
                    </div>
                </section>

                {{-- ===================== INFORMASI TEKNISI ===================== --}}
                <section class="group">
                    <h2
                        class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                        <i class="fas fa-hard-hat text-yellow-500 mr-3"></i> Teknisi
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        @if ($order->teknisi)
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-user text-yellow-600 text-xl"></i>
                                </div>
                                <div>
                                    <p><span class="font-medium text-gray-600">Nama Teknisi:</span>
                                        {{ $order->teknisi->name }}</p>
                                    @if ($order->teknisi->teknisiDetail)
                                        <p class="text-gray-600"><span
                                                class="font-medium text-gray-600">Spesialisasi:</span>
                                            {{ $order->teknisi->teknisiDetail->spesialisasi ?? 'N/A' }}</p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <p class="text-gray-600 italic">Teknisi belum ditugaskan.</p>
                        @endif
                    </div>
                </section>

                {{-- ===================== TOMBOL AKSI ===================== --}}
                <div class="flex justify-center mt-10">
                    <a href="{{ route('customer.orders.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-yellow-500 text-white font-semibold rounded-full
                              hover:bg-yellow-600 transition duration-300 ease-in-out transform hover:scale-105 shadow-md">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Riwayat Pesanan
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
