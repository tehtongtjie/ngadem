<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Ngadem') }}</title>

    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- AOS Animation --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    {{-- Laravel Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-split-left {
            background-image: url('{{ asset('img/foto1.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .bg-split-right {
            background-image: url('{{ asset('img/foto5.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .bg-split-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.75));
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: -1;
            transition: all 0.6s ease-in-out;
        }

        .bg-split-right::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom left, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.75));
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: -1;
            transition: all 0.6s ease-in-out;
        }

        .fade-slide-in {
            opacity: 0;
            transform: translateX(50px);
            animation: fadeSlideIn 0.9s ease-out forwards;
        }

        @keyframes fadeSlideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

@php
    $routeName = Route::currentRouteName();
    $isLogin = $routeName === 'login';
    $isRegister = $routeName === 'register';
@endphp

<body class="font-sans antialiased text-gray-900 bg-gray-50">
    <div class="flex min-h-screen">

        {{-- LEFT or RIGHT SECTION (Gambar + Branding) --}}
        @if ($isLogin)
            {{-- Gambar di kiri --}}
            <div class="hidden lg:flex flex-col justify-between p-10 relative flex-1 bg-split-left text-white overflow-hidden transition-all duration-700 ease-in-out transform hover:scale-[1.01] hover:brightness-105"
                data-aos="fade-right">
                <div class="z-10 w-full fade-slide-in">
                    @include('components.auth-branding')
                </div>
            </div>
        @endif

        {{-- FORM SECTION --}}
        <div class="flex-1 flex items-center justify-center px-6 py-12 sm:px-12 bg-gray-100 relative z-10 fade-slide-in"
            data-aos="{{ $isLogin ? 'fade-left' : 'fade-right' }}">

            {{-- Form Card --}}
            <div
                class="w-full max-w-lg bg-white/90 backdrop-blur-md rounded-xl shadow-2xl p-8 md:p-10
                transition-all duration-500 ease-in-out transform hover:scale-[1.01]">
                {{ $slot }}
            </div>
        </div>

        {{-- RIGHT IMAGE SECTION (for Register only) --}}
        @if ($isRegister)
            <div class="hidden lg:flex flex-col justify-between p-10 relative flex-1 bg-split-right text-white overflow-hidden
                transition-all duration-700 ease-in-out transform hover:scale-[1.01] hover:brightness-105"
                data-aos="fade-left">
                <div class="z-10 w-full fade-slide-in">
                    @include('components.auth-branding')
                </div>
            </div>
        @endif


    </div>

    {{-- AOS Init --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
</body>

</html>
