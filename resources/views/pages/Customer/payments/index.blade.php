@extends('layouts.customer.app')

@section('title', 'Riwayat Pembayaran Anda')

@section('content')
    <div id="header-spacer"></div>

    <main class="container mx-auto px-4 py-8 md:py-16">
        <header class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-bold  text-white drop-shadow-800">Riwayat Pembayaran Anda</h1>
            <p class="mt-2 text-white/90 drop-shadow-600">Lihat semua transaksi pembayaran Anda di satu tempat</p>
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

        @if ($payments->isEmpty())
            {{-- No Payments State --}}
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-6 md:p-8 rounded-xl shadow-lg max-w-2xl mx-auto text-center"
                role="alert">
                <i class="fas fa-info-circle text-4xl text-blue-500 mb-4"></i>
                <p class="font-semibold text-lg mb-2">Belum Ada Riwayat Pembayaran!</p>
                <p class="text-gray-600">Semua tagihan yang perlu dibayar akan muncul di sini.</p>
                <a href="{{ route('customer.orders.index') }}"
                    class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-full
                          hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105 shadow-md">
                    <i class="fas fa-search-dollar mr-2"></i> Lihat Pesanan Saya
                </a>
            </div>
        @else

            {{-- Payments List (Cards for Mobile, Table for Desktop) --}}
            <div class="block lg:hidden space-y-4">
                @foreach ($payments as $payment)
                    <div
                        class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-gray-800">Pembayaran #{{ $payment->id }}</h3>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium
                                  @if ($payment->status_pembayaran === 'pending') bg-yellow-100 text-yellow-700
                                  @elseif ($payment->status_pembayaran === 'berhasil') bg-green-100 text-green-700
                                  @elseif ($payment->status_pembayaran === 'gagal') bg-red-100 text-red-700
                                  @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($payment->status_pembayaran) }}
                            </span>
                        </div>
                        <p class="text-gray-600 mb-2"><span class="font-medium">ID Pesanan:</span> {{ $payment->order_id }}
                        </p>
                        <p class="text-gray-600 mb-2"><span class="font-medium">Jumlah Bayar:</span>
                            Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</p>
                        <p class="text-gray-600 mb-2"><span class="font-medium">Metode:</span>
                            {{ ucfirst($payment->metode_pembayaran) }}</p>
                        <p class="text-gray-600 mb-4"><span class="font-medium">Tanggal:</span>
                            {{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->isoFormat('D MMMM YYYY, HH:mm') }}</p>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('customer.payments.show', $payment->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white font-semibold rounded-full
                                      hover:bg-yellow-600 transition duration-300 ease-in-out transform hover:scale-105">
                                <i class="fas fa-eye mr-2"></i> Lihat Detail
                            </a>
                            @if ($payment->status_pembayaran === 'pending' || $payment->status_pembayaran === 'gagal')
                                <a href="{{ route('customer.payments.upload', $payment->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-full
                                          hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                                    <i class="fas fa-upload mr-2"></i> Unggah Bukti
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="hidden lg:block overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-100">
                <table class="min-w-full text-left text-sm text-gray-700" id="payments-table">
                    <thead class="bg-yellow-50">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-800 cursor-pointer" data-sort="id">ID Pembayaran <i
                                    class="fas fa-sort"></i></th>
                            <th class="px-6 py-4 font-semibold text-gray-800 cursor-pointer" data-sort="order_id">ID Pesanan
                                <i class="fas fa-sort"></i>
                            </th>
                            <th class="px-6 py-4 font-semibold text-gray-800 cursor-pointer" data-sort="jumlah_bayar">Jumlah
                                Bayar <i class="fas fa-sort"></i></th>
                            <th class="px-6 py-4 font-semibold text-gray-800">Metode Pembayaran</th>
                            <th class="px-6 py-4 font-semibold text-gray-800">Status Pembayaran</th>
                            <th class="px-6 py-4 font-semibold text-gray-800 cursor-pointer" data-sort="tanggal_pembayaran">
                                Tanggal Pembayaran <i class="fas fa-sort"></i></th>
                            <th class="px-6 py-4 font-semibold text-gray-800">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr class="border-t hover:bg-yellow-50 transition-colors duration-200">
                                <td class="px-6 py-4">{{ $payment->id }}</td>
                                <td class="px-6 py-4">{{ $payment->order_id }}</td>
                                <td class="px-6 py-4" data-amount="{{ $payment->jumlah_bayar }}">
                                    Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ ucfirst(str_replace('_', ' ', $payment->metode_pembayaran)) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium
                                          @if ($payment->status_pembayaran === 'pending') bg-yellow-100 text-yellow-700
                                          @elseif ($payment->status_pembayaran === 'berhasil') bg-green-100 text-green-700
                                          @elseif ($payment->status_pembayaran === 'gagal') bg-red-100 text-red-700
                                          @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($payment->status_pembayaran) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4" data-date="{{ $payment->tanggal_pembayaran }}">
                                    {{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->isoFormat('D MMMM YYYY, HH:mm') }}
                                </td>
                                <td class="px-6 py-4 flex items-center space-x-2">
                                    <a href="{{ route('customer.payments.show', $payment->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800 font-semibold transition-colors duration-200">
                                        <i class="fas fa-eye mr-1"></i> Lihat Detail
                                    </a>
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

            {{-- Pagination --}}
            @if ($payments->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $payments->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        @endif
    </main>

    @push('scripts')
        <script src="{{ asset('js/index-payment-customer.js') }}"></script>
    @endpush
@endsection