{{-- resources/views/pages/customer/orders/show.blade.php --}}

@extends('layouts.customer.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
    {{-- Spacer untuk memberikan jarak dari navbar yang mungkin fixed atau sticky --}}
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="max-w-3xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-lg border border-gray-100">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">
                Detail Pesanan <span class="text-yellow-600">#{{ $order->id }}</span>
            </h1>

            <div class="space-y-6">
                {{-- Informasi Umum Pesanan --}}
                <div class="border-b pb-4">
                    <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-clipboard-list text-yellow-500 mr-2"></i> Informasi Umum
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                        <div>
                            <p><span class="font-semibold">Tanggal Pesanan:</span>
                                {{ \Carbon\Carbon::parse($order->tanggal_pesanan)->isoFormat('D MMMM YYYY, HH:mm') }}</p>
                            <p><span class="font-semibold">Tanggal Servis:</span>
                                {{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->isoFormat('D MMMM YYYY') }}
                            </p>
                            <p><span class="font-semibold">Jam Servis:</span>
                                {{ \Carbon\Carbon::parse($order->jam_service_diharapkan)->format('H:i') }}</p>
                        </div>
                        <div>
                            <p><span class="font-semibold">Total Harga:</span>
                                Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                            <p><span class="font-semibold">Status:</span>
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if ($order->status_order === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif ($order->status_order === 'diterima') bg-blue-100 text-blue-800
                                    @elseif ($order->status_order === 'dalam_proses') bg-purple-100 text-purple-800
                                    @elseif ($order->status_order === 'selesai') bg-green-100 text-green-800
                                    @elseif ($order->status_order === 'dibatalkan') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $order->status_order)) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Detail Layanan --}}
                <div class="border-b pb-4">
                    <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-tools text-yellow-500 mr-2"></i> Detail Layanan
                    </h2>
                    <p><span class="font-semibold">Nama Layanan:</span> {{ $order->service->nama_layanan ?? 'N/A' }}</p>
                    <p class="text-gray-600"><span class="font-semibold">Deskripsi:</span>
                        {{ $order->service->deskripsi ?? 'N/A' }}</p>
                </div>

                {{-- Informasi Alamat --}}
                <div class="border-b pb-4">
                    <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-map-marker-alt text-yellow-500 mr-2"></i> Alamat Servis
                    </h2>
                    <p class="text-gray-700">{{ $order->alamat_service }}</p>
                </div>

                {{-- Deskripsi Masalah --}}
                <div class="border-b pb-4">
                    <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-comment-alt text-yellow-500 mr-2"></i> Deskripsi Masalah
                    </h2>
                    <p class="text-gray-700">{{ $order->deskripsi_masalah ?? 'Tidak ada deskripsi tambahan.' }}</p>
                </div>

                {{-- Informasi Teknisi (Jika ada) --}}
                <div>
                    <h2 class="text-xl font-bold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-hard-hat text-yellow-500 mr-2"></i> Teknisi
                    </h2>
                    @if ($order->teknisi)
                        <p><span class="font-semibold">Nama Teknisi:</span> {{ $order->teknisi->name }}</p>
                        {{-- Anda bisa menambahkan detail teknisi lain seperti area_layanan, spesialisasi, dll. dari $order->teknisi->teknisiDetail --}}
                    @else
                        <p class="text-gray-600">Teknisi belum ditugaskan.</p>
                    @endif
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-8 text-center">
                <a href="{{ route('customer.orders.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-full
                           hover:bg-gray-300 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Riwayat Pesanan
                </a>
            </div>
        </div>
    </main>
@endsection
