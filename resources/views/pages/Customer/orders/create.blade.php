@extends('layouts.customer.app')

@section('title', 'Pesan Layanan AC Baru')

@section('content')
    <div id="header-spacer"></div>

    <main class="container mx-auto px-4 py-8 md:py-12 lg:py-16">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <header class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 md:p-8">
                <h1 class="text-2xl md:text-3xl font-bold text-center">Jadwalkan Layanan AC Anda</h1>
                <p class="text-center text-sm md:text-base mt-2 opacity-90">Isi detail di bawah untuk memesan layanan AC.
                    Kami akan segera menghubungi Anda.</p>
            </header>

            <div class="p-6 md:p-8 lg:p-10 space-y-8">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm" role="alert">
                        <p class="font-semibold mb-2">Terjadi kesalahan input:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customer.orders.store') }}" method="POST" class="space-y-8" id="order-form">
                    @csrf

                    {{-- Informasi Pemesan --}}
                    <section class="group">
                        <h2
                            class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                            <i class="fas fa-user-circle text-yellow-500 mr-3"></i> Informasi Pemesan
                        </h2>
                        <p class="text-gray-600 mb-6 text-sm">Pastikan data kontak Anda benar untuk kemudahan komunikasi.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="text" id="name" name="name"
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                        required placeholder="Contoh: Budi Santoso"
                                        value="{{ old('name', Auth::user()->name ?? '') }}">
                                    <i
                                        class="fas fa-signature absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="tel" id="phone" name="phone"
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                                        required placeholder="Contoh: 081234567890"
                                        value="{{ old('phone', Auth::user()->phone ?? '') }}">
                                    <i
                                        class="fas fa-phone-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    {{-- Detail Layanan --}}
                    <section class="group">
                        <h2
                            class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                            <i class="fas fa-wrench text-yellow-500 mr-3"></i> Detail Layanan
                        </h2>
                        <p class="text-gray-600 mb-6 text-sm">Pilih layanan, tanggal, dan metode pembayaran.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="service_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Layanan
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="service_id" id="service_id" required
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('service_id') border-red-500 @enderror">
                                        <option value="" disabled {{ old('service_id') == '' ? 'selected' : '' }}>--
                                            Pilih Layanan --</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" data-price="{{ $service->harga_dasar }}"
                                                {{ old('service_id') == $service->id || (isset($selectedServiceId) && $selectedServiceId == $service->id) ? 'selected' : '' }}>
                                                {{ $service->nama_layanan }}
                                                (Rp{{ number_format($service->harga_dasar, 0, ',', '.') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <i
                                        class="fas fa-air-conditioner absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                @error('service_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Metode
                                    Pembayaran <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="metode_pembayaran" id="metode_pembayaran" required
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('metode_pembayaran') border-red-500 @enderror">
                                        <option value="" disabled
                                            {{ old('metode_pembayaran') == '' ? 'selected' : '' }}>-- Pilih Metode --
                                        </option>
                                        @foreach ($metodePembayaranOptions as $method)
                                            <option value="{{ $method }}"
                                                {{ old('metode_pembayaran') == $method ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $method)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i
                                        class="fas fa-credit-card absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                @error('metode_pembayaran')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="tanggal_service_diharapkan"
                                    class="block text-sm font-medium text-gray-700 mb-2">Tanggal Service <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="date" name="tanggal_service_diharapkan" id="tanggal_service_diharapkan"
                                        required
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('tanggal_service_diharapkan') border-red-500 @enderror"
                                        min="{{ date('Y-m-d') }}" value="{{ old('tanggal_service_diharapkan') }}">
                                    <i
                                        class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                @error('tanggal_service_diharapkan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="jam_service_diharapkan" class="block text-sm font-medium text-gray-700 mb-2">Jam
                                    Service <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="time" name="jam_service_diharapkan" id="jam_service_diharapkan" required
                                        step="300"
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('jam_service_diharapkan') border-red-500 @enderror"
                                        value="{{ old('jam_service_diharapkan') }}">
                                    <i
                                        class="fas fa-clock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                @error('jam_service_diharapkan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="alamat_service" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                                    Lengkap <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <textarea name="alamat_service" id="alamat_service" rows="4" required
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('alamat_service') border-red-500 @enderror"
                                        placeholder="Contoh: Jl. Merdeka No. 10, RT 05 RW 03, Kel. Suka Maju, Kec. Damai, Kota Mataram">{{ old('alamat_service', Auth::user()->address ?? '') }}</textarea>
                                    <i class="fas fa-map-marker-alt absolute top-3 left-3 text-gray-400"></i>
                                </div>
                                @error('alamat_service')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Estimasi Harga: <span id="price-preview"
                                    class="font-semibold text-yellow-600">Rp0</span></p>
                        </div>
                    </section>

                    {{-- Deskripsi Masalah --}}
                    <section class="group">
                        <h2
                            class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                            <i class="fas fa-info-circle text-yellow-500 mr-3"></i> Deskripsi Tambahan
                        </h2>
                        <p class="text-gray-600 mb-6 text-sm">Jelaskan masalah AC atau informasi tambahan yang perlu kami
                            ketahui.</p>
                        <div class="relative">
                            <textarea name="deskripsi_masalah" id="deskripsi_masalah" rows="5"
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('deskripsi_masalah') border-red-500 @enderror"
                                placeholder="Contoh: AC tidak dingin, ada suara aneh, atau bocor.">{{ old('deskripsi_masalah') }}</textarea>
                            <i class="fas fa-comment-alt absolute top-3 left-3 text-gray-400"></i>
                        </div>
                        @error('deskripsi_masalah')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </section>

                    {{-- Submit Button --}}
                    <div class="flex justify-center mt-10">
                        <button type="submit"
                            class="w-full md:w-auto px-10 py-4 bg-yellow-600 text-white font-semibold rounded-full shadow-md hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 transition duration-300 ease-in-out transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                            id="submit-button">
                            <i class="fas fa-check-circle mr-2"></i> Konfirmasi Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="{{ asset('js/index-order-customer.js') }}"></script>
    @endpush
@endsection
