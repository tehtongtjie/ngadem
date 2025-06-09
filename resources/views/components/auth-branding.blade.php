@php
    $routeName = Route::currentRouteName();
    $isLogin = $routeName === 'login';
    $isRegister = $routeName === 'register';
@endphp

{{-- Logo Ngadem --}}
<div class="z-10">
    <a href="/" class="inline-block hover:scale-105 transition-transform duration-300">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem" class="h-16 w-auto drop-shadow-lg">
    </a>
</div>

{{-- Tagline & Deskripsi Berdasarkan Halaman --}}
<div class="z-10 mt-auto mb-auto p-4 text-left">
    @if ($isLogin)
        <h1 class="text-4xl xl:text-5xl font-extrabold leading-tight text-white drop-shadow-md">
            Kenyamanan AC Anda,<br class="hidden md:block" />Dalam Genggaman.
        </h1>
        <p class="mt-4 text-base xl:text-lg font-light text-gray-200 drop-shadow-sm max-w-md">
            Masuk ke akun Anda dan nikmati layanan cepat dari teknisi profesional kami.
        </p>
    @elseif ($isRegister)
        <h1 class="text-4xl xl:text-5xl font-extrabold leading-tight text-white drop-shadow-md">
            Siap Bergabung?<br class="hidden md:block" />Bersama Kami.
        </h1>
        <p class="mt-4 text-base xl:text-lg font-light text-gray-200 drop-shadow-sm max-w-md">
            Daftarkan diri Anda sebagai customer atau teknisi, dan mulai perjalanan Anda bersama Ngadem.
        </p>
    @endif
</div>

{{-- Tombol Kembali --}}
<a href="/"
    class="absolute top-8 right-8 flex items-center text-sm font-medium
          {{ $isLogin ? 'text-gray-300 hover:text-white' : 'text-yellow-200 hover:text-white' }}
          transition-colors duration-300 z-10">
    <i class="fas fa-arrow-left mr-2"></i>
    {{ $isLogin ? 'Kembali ke Beranda' : 'Sudah punya akun?' }}
</a>
