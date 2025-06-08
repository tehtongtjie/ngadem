@extends('layouts.customer.app')

@section('title', 'Unggah Bukti Pembayaran #' . $payment->id)

@section('content')
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="max-w-xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-lg border border-gray-100">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">
                Unggah Bukti Pembayaran <span class="text-yellow-600">#{{ $payment->id }}</span>
            </h1>
            <p class="text-center text-gray-700 mb-8">
                Untuk pesanan #{{ $payment->order_id }} dengan total
                <strong class="text-yellow-600">Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</strong>.
                Mohon unggah bukti transfer atau pembayaran Anda di sini.
            </p>

            {{-- Menampilkan pesan error validasi --}}
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-lg shadow-sm" role="alert">
                    <p class="font-bold mb-2">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form unggah bukti pembayaran --}}
            <form action="{{ route('customer.payments.store-proof', $payment->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Pilih File Bukti
                        Pembayaran <span class="text-red-500">*</span></label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('bukti_pembayaran') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG, GIF, SVG. Max: 2MB.</p>
                    @error('bukti_pembayaran')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-yellow-600 text-white font-bold text-lg rounded-full shadow-lg hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 transition duration-300 ease-in-out transform hover:scale-105">
                        Unggah Bukti
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('customer.payments.show', $payment->id) }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-800 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail Pembayaran
                </a>
            </div>
        </div>
    </main>
@endsection
