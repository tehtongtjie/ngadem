@extends('layouts.customer.app')

@section('title', 'Profil Saya')

@section('content')
    <div id="header-spacer" class="h-16 md:h-20"></div>

    <main class="container mx-auto px-4 py-8 md:py-12 lg:py-16">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <header class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 md:p-8">
                <h1 class="text-2xl md:text-3xl font-bold text-center">Profil Saya</h1>
                <p class="text-center text-sm md:text-base mt-2 opacity-90">Kelola informasi pribadi Anda di sini.</p>
            </header>

            <div class="p-6 md:p-8 lg:p-10 space-y-8">
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

                <div class="bg-gray-50 p-6 rounded-lg space-y-4 text-gray-700">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Nama Lengkap</p>
                            <p class="mt-1 font-semibold">{{ $user->name ?? 'Belum diatur' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Email</p>
                            <p class="mt-1 font-semibold">{{ $user->email ?? 'Belum diatur' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Nomor Telepon</p>
                            <p class="mt-1 font-semibold">{{ $user->phone ?? 'Belum diatur' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Alamat</p>
                            <p class="mt-1 font-semibold">{{ $user->address ?? 'Belum diatur' }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Bergabung Sejak</p>
                        <p class="mt-1 font-semibold">
                            {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('D MMMM YYYY') }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('customer.dashboard') }}"
                        class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-full
                              hover:bg-gray-300 transition duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                    </a>
                    <a href="{{ route('customer.profile.edit', $user->id) }}"
                        class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-full
                              hover:bg-yellow-700 transition duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-edit mr-2"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
