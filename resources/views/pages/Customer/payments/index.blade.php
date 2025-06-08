{{-- resources/views/pages/customer/payments/index.blade.php --}}

@extends('layouts.customer.app')

@section('title', 'Riwayat Pembayaran Anda')

@section('content')
    {{-- Spacer untuk memberikan jarak dari navbar yang mungkin fixed atau sticky --}}
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">Riwayat Pembayaran Anda</h1>

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

        @if ($payments->isEmpty())
            {{-- Tampilan jika tidak ada pembayaran --}}
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-6 rounded-lg shadow-md max-w-2xl mx-auto text-center"
                role="alert">
                <p class="font-bold text-lg mb-2">Belum ada riwayat pembayaran!</p>
                <p>Anda belum melakukan pembayaran. Semua tagihan yang perlu dibayar akan muncul di sini.</p>
                <a href="{{ route('customer.orders.index') }}"
                    class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-search-dollar mr-2"></i> Lihat Pesanan Saya
                </a>
            </div>
        @else
            {{-- Tampilan jika ada pembayaran --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-300">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead class="bg-yellow-200">
                        <tr>
                            <th class="px-6 py-4 font-medium text-gray-700">ID Pembayaran</th>
                            <th class="px-6 py-4 font-medium text-gray-700">ID Pesanan</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Jumlah Bayar</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Metode Pembayaran</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Status Pembayaran</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Tanggal Pembayaran</th>
                            <th class="px-6 py-4 font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr class="border-t hover:bg-yellow-50 transition-colors">
                                <td class="px-6 py-4">{{ $payment->id }}</td>
                                <td class="px-6 py-4">{{ $payment->order_id }}</td>
                                <td class="px-6 py-4">Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ ucfirst($payment->metode_pembayaran) }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if ($payment->status_pembayaran === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif ($payment->status_pembayaran === 'berhasil') bg-green-100 text-green-800
                                        @elseif ($payment->status_pembayaran === 'gagal') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($payment->status_pembayaran) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->isoFormat('D MMMM YYYY, HH:mm') }}
                                </td>
                                <td class="px-6 py-4 flex items-center space-x-2"> {{-- Tambahkan flex untuk tombol --}}
                                    <a href="{{ route('customer.payments.show', $payment->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800 font-semibold">
                                        Lihat Detail
                                    </a>
                                    {{-- Tambahkan tombol Unggah Bukti jika statusnya masih pending --}}
                                    @if ($payment->status_pembayaran === 'pending' || $payment->status_pembayaran === 'gagal')
                                        <a href="{{ route('customer.payments.upload', $payment->id) }}"
                                            class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-md text-xs font-semibold hover:bg-blue-600 transition duration-300">
                                            <i class="fas fa-upload mr-1"></i> Unggah Bukti
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Jika Anda menggunakan paginasi di controller (misalnya $payments = Payment::paginate(10);), tambahkan ini --}}
            {{-- @if ($payments->hasPages())
                <div class="mt-8">
                    {{ $payments->links() }}
                </div>
            @endif --}}
        @endif
    </div>
@endsection
