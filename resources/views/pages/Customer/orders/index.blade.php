{{-- resources/views/pages/customer/orders/index.blade.php --}}

@extends('layouts.customer.app')

@section('title', 'Riwayat Pesanan Anda')

@section('content')
    {{-- Spacer untuk memberikan jarak dari navbar yang mungkin fixed atau sticky --}}
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">Riwayat Pesanan Anda</h1>

        {{-- Menampilkan pesan sukses atau error dari session --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($orders->isEmpty())
            {{-- Tampilan jika tidak ada pesanan --}}
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-6 rounded-lg shadow-md max-w-2xl mx-auto text-center"
                role="alert">
                <p class="font-bold text-lg mb-2">Belum ada pesanan!</p>
                <p>Sepertinya Anda belum melakukan pemesanan. Mari jelajahi layanan kami dan buat pesanan pertama Anda.</p>
                <a href="{{ route('customer.service.index') }}"
                    class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-plus-circle mr-2"></i> Pesan Layanan Sekarang
                </a>
            </div>
        @else
            {{-- Tampilan jika ada pesanan --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-300">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead class="bg-yellow-200">
                        <tr>
                            <th class="px-6 py-4 font-medium text-gray-700">Nomor Pesanan</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Layanan</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Tanggal Servis</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Status</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Total Harga</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-t hover:bg-yellow-50 transition-colors">
                                <td class="px-6 py-4">{{ $order->id }}</td>
                                {{-- Mengakses nama layanan dari relasi. Pastikan relasi 'service' sudah didefinisikan di model Order. --}}
                                <td class="px-6 py-4">{{ $order->service->nama_layanan ?? 'Layanan tidak ditemukan' }}</td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if ($order->status_order === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif ($order->status_order === 'diterima') bg-blue-100 text-blue-800
                                        @elseif ($order->status_order === 'dalam_proses') bg-purple-100 text-purple-800
                                        @elseif ($order->status_order === 'selesai') bg-green-100 text-green-800
                                        @elseif ($order->status_order === 'dibatalkan') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $order->status_order)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('customer.orders.show', $order->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800 font-semibold">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Jika Anda menggunakan paginasi di controller (misalnya $orders = Order::paginate(10);), tambahkan ini --}}
            {{-- @if ($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif --}}
        @endif
    </div>
@endsection
