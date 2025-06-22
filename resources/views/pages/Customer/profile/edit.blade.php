@extends('layouts.customer.app')

@section('title', 'Edit Profil Saya')

@section('content')

    {{-- ========================== HEADER SPACER ========================== --}}
    <div id="header-spacer" class="h-10 md:h-15"></div>

    {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="container mx-auto px-4 py-8 md:py-12 lg:py-16">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            {{-- ---------- PAGE HEADER ---------- --}}
            <header class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 md:p-8">
                <h1 class="text-2xl md:text-3xl font-bold text-center">Edit Profil Saya</h1>
                <p class="text-center text-sm md:text-base mt-2 opacity-90">Perbarui informasi pribadi Anda untuk pengalaman
                    terbaik.</p>
            </header>

            <div class="p-6 md:p-8 lg:p-10 space-y-8">

                {{-- ---------- SESSION & ERROR HANDLING ---------- --}}
                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm"
                        role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

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

                {{-- ========================== FORM MULAI ========================== --}}
                <form action="{{ route('customer.profile.update', $user->id) }}" method="POST" class="space-y-8"
                    id="profile-form">
                    @csrf
                    @method('PUT')

                    {{-- ---------- INFORMASI AKUN ---------- --}}
                    <section class="group">
                        <h2
                            class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                            <i class="fas fa-id-card-alt text-yellow-500 mr-3"></i> Informasi Akun
                        </h2>
                        <p class="text-gray-600 mb-6 text-sm">Pastikan semua detail akurat untuk komunikasi yang lancar.</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama Lengkap --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="text" id="name" name="name"
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                        required value="{{ old('name', $user->name ?? '') }}"
                                        placeholder="Contoh: Budi Santoso">
                                    <i
                                        class="fas fa-signature absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="email" id="email" name="email"
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                        required value="{{ old('email', $user->email ?? '') }}"
                                        placeholder="Contoh: budi@example.com">
                                    <i
                                        class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Nomor Telepon --}}
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                    Telepon</label>
                                <div class="relative">
                                    <input type="tel" id="phone" name="phone"
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                                        value="{{ old('phone', $user->phone ?? '') }}" placeholder="Contoh: 081234567890">
                                    <i
                                        class="fas fa-phone-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                                    Lengkap</label>
                                <div class="relative">
                                    <textarea name="address" id="address" rows="4"
                                        class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('address') border-red-500 @enderror"
                                        placeholder="Contoh: Jl. Merdeka No. 10, Mataram">{{ old('address', $user->address ?? '') }}</textarea>
                                    <i class="fas fa-map-marker-alt absolute top-3 left-3 text-gray-400"></i>
                                </div>
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    {{-- ---------- UBAH PASSWORD OPSIONAL ---------- --}}
                    <section class="group">
                        <h2
                            class="text-lg md:text-xl font-semibold text-gray-800 mb-4 flex items-center transition-transform duration-300 group-hover:translate-x-1">
                            <i class="fas fa-lock text-yellow-500 mr-3"></i> Ubah Password (Opsional)
                        </h2>
                        <p class="text-gray-600 mb-6 text-sm">Isi hanya jika Anda ingin mengubah password.</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Password Lama --}}
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                    Lama</label>
                                <div class="relative">
                                    <input type="password" id="current_password" name="current_password"
                                        class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('current_password') border-red-500 @enderror">
                                    <i
                                        class="fas fa-key absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <button type="button"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 toggle-password"
                                        data-target="current_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password Baru --}}
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                    Baru</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password"
                                        class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('password') border-red-500 @enderror">
                                    <i
                                        class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <button type="button"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 toggle-password"
                                        data-target="password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password Baru --}}
                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                    <i
                                        class="fas fa-lock-open absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <button type="button"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 toggle-password"
                                        data-target="password_confirmation">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- ---------- ACTION BUTTONS ---------- --}}
                    <a href="{{ route('customer.profile.show', ['profile' => auth()->user()->id]) }}"
                        class="px-5 py-3 bg-gray-200 text-gray-700 font-semibold rounded-full hover:bg-gray-300 transition duration-300 ease-in-out transform hover:scale-105 text-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-3 bg-yellow-600 text-white font-semibold rounded-full shadow-md hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 transition-all duration-300 ease-in-out transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                        id="submit-button">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>

                </form>
                {{-- ========================== FORM SELESAI ========================== --}}
            </div>
        </div>
    </main>

    {{-- ========================== SCRIPT SECTION ========================== --}}
    @push('attributes')
        <script src="{{ asset('js/edit-profile-customer.js') }}"></script>
    @endpush

@endsection
