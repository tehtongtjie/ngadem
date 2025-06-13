@extends('layouts.customer.app')

@section('title', 'Riwayat Pesanan Anda')

@section('content')
    <div id="header-spacer"></div>

    <main class="container mx-auto px-4 py-8 md:py-16">
        <header class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-800">Riwayat Pesanan Anda</h1>
            <p class="mt-2 text-white/90 drop-shadow-600">Lihat semua pesanan Anda di satu tempat</p>
        </header>

        {{-- Session Messages --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-lg shadow-md max-w-3xl mx-auto"
                role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-lg shadow-md max-w-3xl mx-auto"
                role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($orders->isEmpty())
            {{-- No Orders State --}}
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-6 md:p-8 rounded-xl shadow-lg max-w-2xl mx-auto text-center"
                role="alert">
                <i class="fas fa-info-circle text-4xl text-blue-500 mb-4"></i>
                <p class="font-semibold text-lg mb-2">Belum Ada Pesanan!</p>
                <p class="text-gray-600">Mulai jelajahi layanan kami dan buat pesanan pertama Anda sekarang.</p>
                <a href="{{ route('customer.service.index') }}"
                    class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-full
                          hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105 shadow-md">
                    <i class="fas fa-plus-circle mr-2"></i> Pesan Layanan Sekarang
                </a>
            </div>
        @else
            {{-- Orders List (Table for Desktop, Cards for Mobile) --}}
            <div class="block lg:hidden space-y-4">
                @foreach ($orders as $order)
                    <div
                        class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-gray-800">Pesanan #{{ $order->id }}</h3>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium
                                  @if ($order->status_order === 'pending') bg-yellow-100 text-yellow-700
                                  @elseif ($order->status_order === 'diterima') bg-blue-100 text-blue-700
                                  @elseif ($order->status_order === 'dalam_proses') bg-purple-100 text-purple-700
                                  @elseif ($order->status_order === 'selesai') bg-green-100 text-green-700
                                  @elseif ($order->status_order === 'dibatalkan') bg-red-100 text-red-700
                                  @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $order->status_order)) }}
                            </span>
                        </div>
                        <p class="text-gray-600 mb-2"><span class="font-medium">Layanan:</span>
                            {{ $order->service->nama_layanan ?? 'N/A' }}</p>
                        <p class="text-gray-600 mb-2"><span class="font-medium">Tanggal Servis:</span>
                            {{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->isoFormat('D MMMM YYYY') }}</p>
                        <p class="text-gray-600 mb-4"><span class="font-medium">Total Harga:</span>
                            Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                        <a href="{{ route('customer.orders.show', $order->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white font-semibold rounded-full
                                  hover:bg-yellow-600 transition duration-300 ease-in-out transform hover:scale-105">
                            <i class="fas fa-eye mr-2"></i> Lihat Detail
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="hidden lg:block overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-100">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead class="bg-yellow-50">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-800">Nomor Pesanan</th>
                            <th class="px-6 py-4 font-semibold text-gray-800">Layanan</th>
                            <th class="px-6 py-4 font-semibold text-gray-800">Tanggal Servis</th>
                            <th class="px-6 py-4 font-semibold text-gray-800">Status</th>
                            <th class="px-6 py-4 font-semibold text-gray-800">Total Harga</th>
                            <th class="px-6 py-4 font-semibold text-gray-800">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-t hover:bg-yellow-50 transition-colors duration-200">
                                <td class="px-6 py-4">{{ $order->id }}</td>
                                <td class="px-6 py-4">{{ $order->service->nama_layanan ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium
                                          @if ($order->status_order === 'pending') bg-yellow-100 text-yellow-700
                                          @elseif ($order->status_order === 'diterima') bg-blue-100 text-blue-700
                                          @elseif ($order->status_order === 'dalam_proses') bg-purple-100 text-purple-700
                                          @elseif ($order->status_order === 'selesai') bg-green-100 text-green-700
                                          @elseif ($order->status_order === 'dibatalkan') bg-red-100 text-red-700
                                          @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $order->status_order)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('customer.orders.show', $order->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800 font-semibold transition-colors duration-200">
                                        <i class="fas fa-eye mr-1"></i> Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($orders->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $orders->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        @endif
    </main>

    @push('scripts')
        <script src="{{ asset('js/index-order-customer.js') }}"></script>
    @endpush
@endsection
