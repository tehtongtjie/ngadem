{{-- resources/views/pages/customer/orders/create.blade.php --}}

@extends('layouts.customer.app')

@section('title', 'Pesan Layanan AC Baru')

@section('content')
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <main class="container mx-auto px-4 py-8 md:py-12 lg:py-16">
        <div
            class="max-w-4xl mx-auto bg-white p-6 md:p-8 lg:p-10 rounded-xl shadow-2xl border border-gray-100 transform transition-all duration-300 hover:scale-[1.005]">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 text-center drop-shadow-lg leading-tight">
                Jadwalkan Layanan AC Anda
            </h1>
            <p class="text-center text-lg text-gray-700 mb-10 max-w-2xl mx-auto">
                Isi detail di bawah ini untuk memesan layanan AC. Tim kami akan menghubungi Anda untuk konfirmasi jadwal.
            </p>

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-lg shadow-sm" role="alert">
                    <p class="font-bold mb-2">Terjadi kesalahan input:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.orders.store') }}" method="POST" class="space-y-8">
                @csrf

                {{-- Bagian Informasi Pemesan --}}
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-circle text-yellow-500 mr-3"></i> Informasi Pemesan
                    </h2>
                    <p class="text-gray-600 mb-4">Pastikan data kontak Anda benar agar kami mudah menghubungi.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('name') border-red-500 @enderror"
                                    required placeholder="Contoh: Budi Santoso"
                                    value="{{ old('name', Auth::user()->name ?? '') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-signature text-gray-400"></i>
                                </div>
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('phone') border-red-500 @enderror"
                                    required placeholder="Contoh: 081234567890"
                                    value="{{ old('phone', Auth::user()->phone ?? '') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone-alt text-gray-400"></i>
                                </div>
                            </div>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Bagian Detail Layanan --}}
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-wrench text-yellow-500 mr-3"></i> Detail Layanan
                    </h2>
                    <p class="text-gray-600 mb-4">Pilih jenis layanan AC dan metode pembayaran.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Pilih Layanan --}}
                        <div>
                            <label for="service_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Layanan <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="service_id" id="service_id" required
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('service_id') border-red-500 @enderror">
                                    <option value="" disabled {{ old('service_id') == '' ? 'selected' : '' }}>-- Pilih
                                        Layanan --</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            {{ old('service_id') == $service->id || (isset($selectedServiceId) && $selectedServiceId == $service->id) ? 'selected' : '' }}>
                                            {{ $service->nama_layanan }}
                                            (Rp{{ number_format($service->harga_dasar, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-air-conditioner text-gray-400"></i>
                                </div>
                            </div>
                            @error('service_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- --- TAMBAHKAN INI: Pilih Metode Pembayaran --- --}}
                        <div>
                            <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Metode
                                Pembayaran <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="metode_pembayaran" id="metode_pembayaran" required
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('metode_pembayaran') border-red-500 @enderror">
                                    <option value="" disabled {{ old('metode_pembayaran') == '' ? 'selected' : '' }}>
                                        -- Pilih Metode Pembayaran --</option>
                                    @foreach ($metodePembayaranOptions as $method)
                                        <option value="{{ $method }}"
                                            {{ old('metode_pembayaran') == $method ? 'selected' : '' }}>
                                            {{ $method }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-cash-register text-gray-400"></i>
                                </div>
                            </div>
                            @error('metode_pembayaran')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- --- AKHIR PENAMBAHAN METODE PEMBAYARAN --- --}}

                        <div>
                            <label for="tanggal_service_diharapkan"
                                class="block text-sm font-medium text-gray-700 mb-2">Tanggal Service <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="date" name="tanggal_service_diharapkan" id="tanggal_service_diharapkan"
                                    required
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('tanggal_service_diharapkan') border-red-500 @enderror"
                                    min="{{ date('Y-m-d') }}" value="{{ old('tanggal_service_diharapkan') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                </div>
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
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('jam_service_diharapkan') border-red-500 @enderror"
                                    value="{{ old('jam_service_diharapkan') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clock text-gray-400"></i>
                                </div>
                            </div>
                            @error('jam_service_diharapkan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="alamat_service" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                                Lengkap <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <textarea name="alamat_service" id="alamat_service" rows="3" required
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('alamat_service') border-red-500 @enderror"
                                    placeholder="Contoh: Jl. Merdeka No. 10, RT 05 RW 03, Kel. Suka Maju, Kec. Damai, Kota Mataram">{{ old('alamat_service', Auth::user()->address ?? '') }}</textarea>
                                <div class="absolute top-3 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                            </div>
                            @error('alamat_service')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Bagian Deskripsi Masalah --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-yellow-500 mr-3"></i> Deskripsi Tambahan
                    </h2>
                    <p class="text-gray-600 mb-4">Berikan detail masalah AC Anda atau informasi tambahan yang perlu kami
                        ketahui.</p>

                    <div>
                        <label for="deskripsi_masalah" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                            Masalah (Opsional)</label>
                        <div class="relative">
                            <textarea name="deskripsi_masalah" id="deskripsi_masalah" rows="4"
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('deskripsi_masalah') border-red-500 @enderror"
                                placeholder="Contoh: AC tidak dingin, ada suara aneh, atau bocor.">{{ old('deskripsi_masalah') }}</textarea>
                            <div class="absolute top-3 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-comment-alt text-gray-400"></i>
                            </div>
                        </div>
                        @error('deskripsi_masalah')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex justify-center mt-10">
                    <button type="submit"
                        class="w-full md:w-auto px-10 py-4 bg-yellow-600 text-white font-bold text-lg rounded-full shadow-lg hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 transition duration-300 ease-in-out transform hover:scale-105">
                        Konfirmasi Pesanan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
