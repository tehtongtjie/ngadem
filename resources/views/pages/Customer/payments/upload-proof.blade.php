@extends('layouts.customer.app')

@section('title', 'Unggah Bukti Pembayaran #' . $payment->id)

@section('content')
    <div id="header-spacer" class="h-10 md:h-10"></div>

    <main class="container mx-auto px-4 py-8 md:py-12 lg:py-16">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <header class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 md:p-8">
                <h1 class="text-2xl md:text-3xl font-bold text-center">
                    Unggah Bukti Pembayaran <span class="font-extrabold">#{{ $payment->id }}</span>
                </h1>
                <p class="text-center text-sm md:text-base mt-2 opacity-90">
                    Untuk pesanan #{{ $payment->order_id }} dengan total
                    <span class="font-semibold">Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</span>
                </p>
            </header>

            <div class="p-6 md:p-8 space-y-8">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm" role="alert">
                        <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customer.payments.store-proof', $payment->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6" id="upload-form">
                    @csrf

                    <div>
                        <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih File Bukti Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center
                                    hover:border-yellow-500 transition-colors duration-300"
                            id="drop-zone">
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*" required
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600">Seret dan lepas gambar di sini atau klik untuk memilih file</p>
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG, GIF, SVG. Max: 2MB.</p>
                            </div>
                            <div id="preview" class="hidden mt-4 max-w-xs mx-auto">
                                <img id="preview-image" src="" alt="Pratinjau Bukti Pembayaran"
                                    class="w-full h-auto rounded-lg shadow-md">
                                <button type="button" id="remove-preview"
                                    class="mt-2 text-red-500 hover:text-red-600 text-sm font-semibold">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </div>
                        </div>
                        @error('bukti_pembayaran')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-center mt-6">
                        <button type="submit"
                            class="w-full md:w-auto px-8 py-3 bg-yellow-600 text-white font-semibold rounded-full shadow-md
                                       hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300
                                       transition duration-300 ease-in-out transform hover:scale-105
                                       disabled:opacity-50 disabled:cursor-not-allowed"
                            id="submit-button">
                            <i class="fas fa-upload mr-2"></i> Unggah Bukti
                        </button>
                    </div>
                </form>

                <div class="text-center mt-6">
                    <a href="{{ route('customer.payments.show', $payment->id) }}"
                        class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 font-semibold
                              rounded-full hover:bg-gray-100 transition duration-300 ease-in-out">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail Pembayaran
                    </a>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="{{ asset('js/upload-proof-payment-customer.js') }}"></script>
    @endpush
@endsection
