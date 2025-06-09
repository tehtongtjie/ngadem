{{-- resources/views/pages/customer/profile/edit.blade.php --}}

@extends('layouts.customer.app')

@section('title', 'Edit Profil Saya')

@section('content')
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <main class="container mx-auto px-4 py-8 md:py-12 lg:py-16">
        <div class="max-w-3xl mx-auto bg-white p-6 md:p-8 lg:p-10 rounded-xl shadow-2xl border border-gray-100">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 text-center drop-shadow-lg leading-tight">
                Edit Profil Saya
            </h1>
            <p class="text-center text-lg text-gray-700 mb-10 max-w-2xl mx-auto">
                Perbarui informasi pribadi Anda di sini. Pastikan semua detail akurat.
            </p>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-lg shadow-sm"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-lg shadow-sm" role="alert">
                    {{ session('error') }}
                </div>
            @endif
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

            <form action="{{ route('customer.profile.update', $user->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT') {{-- Penting: Gunakan method PUT untuk update --}}

                {{-- Bagian Informasi Dasar --}}
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-id-card-alt text-yellow-500 mr-3"></i> Informasi Akun
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Lengkap --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('name') border-red-500 @enderror"
                                    required value="{{ old('name', $user->name ?? '') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-signature text-gray-400"></i>
                                </div>
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
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('email') border-red-500 @enderror"
                                    required value="{{ old('email', $user->email ?? '') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nomor Telepon --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('phone') border-red-500 @enderror"
                                    value="{{ old('phone', $user->phone ?? '') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone-alt text-gray-400"></i>
                                </div>
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
                                <textarea name="address" id="address" rows="3"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('address') border-red-500 @enderror"
                                    placeholder="Masukkan alamat lengkap Anda">{{ old('address', $user->address ?? '') }}</textarea>
                                <div class="absolute top-3 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                            </div>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Bagian Ubah Password --}}
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-lock text-yellow-500 mr-3"></i> Ubah Password (Opsional)
                    </h2>
                    <p class="text-gray-600 mb-4">Isi bagian ini hanya jika Anda ingin mengubah password Anda.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Password Lama --}}
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                Lama</label>
                            <div class="relative">
                                <input type="password" id="current_password" name="current_password"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('current_password') border-red-500 @enderror">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-gray-400"></i>
                                </div>
                            </div>
                            @error('current_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password Baru --}}
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('password') border-red-500 @enderror">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
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
                                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock-open text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex justify-center md:justify-end space-x-4 pt-6">
                    <a href="{{ route('customer.profile.index') }}"
                        class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-full hover:bg-gray-300 transition duration-300 ease-in-out transform hover:scale-105">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-yellow-600 text-white font-bold rounded-full shadow-lg hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 transition duration-300 ease-in-out transform hover:scale-105">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
