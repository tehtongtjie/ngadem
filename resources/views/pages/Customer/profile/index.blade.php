{{-- resources/views/pages/customer/profile/index.blade.php --}}

@extends('layouts.customer.app')

@section('title', 'Profil Saya')

@section('content')
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="max-w-xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-lg border border-gray-100">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Profil Saya</h1>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4 text-gray-700">
                <p><span class="font-semibold">Nama Lengkap:</span> {{ $user->name ?? 'N/A' }}</p>
                <p><span class="font-semibold">Email:</span> {{ $user->email ?? 'N/A' }}</p>
                {{-- Tambahkan detail lain dari model User atau relasi profil jika ada --}}
                {{-- <p><span class="font-semibold">Nomor Telepon:</span> {{ $user->phone ?? 'N/A' }}</p> --}}
                {{-- <p><span class="font-semibold">Alamat:</span> {{ $user->address ?? 'N/A' }}</p> --}}
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('customer.dashboard') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-full
                           hover:bg-gray-300 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
                {{-- Tombol Edit Profil (jika Anda membuat rute dan form edit) --}}
                <a href="{{ route('customer.profile.edit', $user->id) }}"
                    class="ml-4 inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-full
                           hover:bg-yellow-700 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-edit mr-2"></i> Edit Profil
                </a>
            </div>
        </div>
    </main>
@endsection
