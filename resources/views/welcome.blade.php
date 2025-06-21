<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Ngadem - Solusi AC Profesional</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

</head>

<body class="bg-white">
    <!-- =================== HEADER / NAVBAR =================== -->
    <header id="navbar" class="navbar fixed top-0 left-0 right-0 z-50 py-4 px-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem" class="h-10 w-auto">
            </a>

            <nav class="hidden md:flex items-center space-x-8">
                <a href="#services" class="text-white hover:text-yellow-400 font-medium transition-colors">Layanan</a>
                <a href="#gallery" class="text-white hover:text-yellow-400 font-medium transition-colors">Galeri</a>
                <a href="#about" class="text-white hover:text-yellow-400 font-medium transition-colors">Tentang</a>
                @auth
                    <a href="{{ route('customer.dashboard') }}"
                        class="text-white hover:text-yellow-400 font-medium transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white hover:text-yellow-400 font-medium transition-colors">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold py-2 px-6 rounded-lg transition-colors">Daftar</a>
                    @endif
                @endauth
            </nav>

            <button id="mobile-menu-btn" class="md:hidden text-white p-2">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <div id="mobile-menu" class="mobile-menu">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem" class="h-8 w-auto">
                        {{-- <span class="text-yellow-400 font-bold text-lg">Ngadem</span> --}}
                    </div>
                    <button id="mobile-menu-close" class="text-white p-2">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <nav class="space-y-6">
                    <a href="#services"
                        class="block text-white hover:text-yellow-400 font-medium text-lg transition-colors">Layanan</a>
                    <a href="#gallery"
                        class="block text-white hover:text-yellow-400 font-medium text-lg transition-colors">Galeri</a>
                    <a href="#about"
                        class="block text-white hover:text-yellow-400 font-medium text-lg transition-colors">Tentang</a>

                    @auth
                        <a href="{{ route('customer.dashboard') }}"
                            class="block text-white hover:text-yellow-400 font-medium text-lg transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="block text-white hover:text-yellow-400 font-medium text-lg transition-colors">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="block bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold py-3 px-6 rounded-lg text-center transition-colors mt-4">Daftar</a>
                        @endif
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- =================== HERO SECTION =================== -->

    <section class="hero-bg min-h-screen flex items-center justify-center text-center text-white px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6">
                Kesejukan Elite dengan <span class="text-yellow-500 font-black">Ngadem</span>
            </h1>
            <p class="text-lg md:text-xl mb-10 opacity-90 font-semibold">
                Layanan AC profesional dengan teknologi terdepan untuk kenyamanan tanpa batas.
            </p>
            <a href="{{ route('register') }}"
                class="btn-primary inline-flex items-center text-gray-900 font-extrabold py-4 px-8 rounded-xl text-lg">
                <i class="fas fa-sun mr-2"></i>
                Mulai Sekarang
            </a>
        </div>
    </section>


    <!-- =================== SERVICES SECTION =================== -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Layanan Unggulan Kami</h2>
                <p class="text-lg text-gray-600">Solusi lengkap untuk semua kebutuhan AC Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $services = [
                        [
                            'icon' => 'fa-broom',
                            'title' => 'Pembersihan AC',
                            'desc' => 'Udara segar dengan pembersihan menyeluruh',
                        ],
                        [
                            'icon' => 'fa-tools',
                            'title' => 'Perbaikan AC',
                            'desc' => 'Solusi cepat untuk semua masalah AC',
                        ],
                        ['icon' => 'fa-snowflake', 'title' => 'Isi Freon', 'desc' => 'Pendinginan optimal setiap saat'],
                        [
                            'icon' => 'fa-cogs',
                            'title' => 'Instalasi AC',
                            'desc' => 'Pemasangan presisi untuk performa terbaik',
                        ],
                    ];
                @endphp

                @foreach ($services as $service)
                    <div class="service-card bg-white rounded-xl p-8 text-center shadow-lg">
                        <div
                            class="w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-full flex items-center justify-center">
                            <i class="fas {{ $service['icon'] }} text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ $service['title'] }}</h3>
                        <p class="text-gray-600">{{ $service['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =================== TESTIMONIALS SECTION =================== -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Cerita Pelanggan Kami</h2>
                <p class="text-lg text-gray-600">Kepuasan pelanggan adalah prioritas utama kami</p>
            </div>

            <div class="relative overflow-hidden rounded-xl">
                <div class="carousel-track" id="testimonial-track">
                    @php
                        $testimonials = [
                            [
                                'name' => 'Budi Santoso',
                                'text' => 'Pelayanan luar biasa! AC saya kembali dingin dalam waktu singkat.',
                            ],
                            [
                                'name' => 'Siti Aminah',
                                'text' => 'Teknisi profesional dan harga transparan. Ngadem is the best!',
                            ],
                            ['name' => 'Andi Wijaya', 'text' => 'Pembersihan AC sangat rapi, udara jadi segar!'],
                            ['name' => 'Rina Lestari', 'text' => 'Instalasi AC baru dilakukan dengan presisi tinggi.'],
                        ];
                    @endphp

                    @foreach ($testimonials as $testimonial)
                        <div class="carousel-slide">
                            <div class="bg-gray-50 rounded-xl p-8 mx-4 text-center">
                                <div class="flex justify-center mb-4">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star text-yellow-400"></i>
                                    @endfor
                                </div>
                                <p class="text-lg text-gray-700 mb-6 italic">"{{ $testimonial['text'] }}"</p>
                                <h4 class="text-xl font-semibold text-gray-900">{{ $testimonial['name'] }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white shadow-lg rounded-full p-3 hover:bg-gray-50 transition-colors"
                    id="testimonial-prev">
                    <i class="fas fa-chevron-left text-gray-600"></i>
                </button>
                <button
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white shadow-lg rounded-full p-3 hover:bg-gray-50 transition-colors"
                    id="testimonial-next">
                    <i class="fas fa-chevron-right text-gray-600"></i>
                </button>

                <div class="flex justify-center mt-8 space-x-2">
                    @foreach ($testimonials as $index => $testimonial)
                        <button
                            class="w-3 h-3 rounded-full transition-colors testimonial-dot {{ $index === 0 ? 'bg-orange-500' : 'bg-gray-300' }}"
                            data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- =================== GALLERY SECTION =================== -->
    <section id="gallery" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Galeri Proyek Kami</h2>
                <p class="text-lg text-gray-600">Lihat hasil kerja profesional tim Ngadem</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $gallery = [
                        ['img' => 'foto1.jpg', 'title' => 'Pembersihan Unit'],
                        ['img' => 'foto2.jpg', 'title' => 'Perbaikan AC'],
                        ['img' => 'foto3.jpg', 'title' => 'Instalasi Baru'],
                        ['img' => 'foto4.jpg', 'title' => 'Isi Freon'],
                        ['img' => 'foto5.jpg', 'title' => 'Perawatan Rutin'],
                        ['img' => 'foto6.jpg', 'title' => 'Pengecekan Pipa'],
                    ];
                @endphp

                @foreach ($gallery as $item)
                    <div class="gallery-item" data-src="{{ asset('img/' . $item['img']) }}">
                        <img src="{{ asset('img/' . $item['img']) }}" alt="{{ $item['title'] }}"
                            class="w-full h-64 object-cover">
                        <div class="gallery-overlay">
                            <div class="text-white text-center">
                                <h3 class="text-xl font-semibold mb-2">{{ $item['title'] }}</h3>
                                <i class="fas fa-search-plus text-2xl"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =================== CALL TO ACTION SECTION =================== -->
    <section class="py-20 bg-gradient-to-r from-orange-500 to-yellow-500">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Raih Kesejukan Bersama Ngadem!</h2>
            <p class="text-lg text-gray-800 mb-10">Daftar sekarang untuk layanan AC premium dari tim profesional kami.
            </p>
            <a href="{{ route('register') }}"
                class="btn-primary inline-flex items-center text-gray-900 font-bold py-4 px-8 rounded-xl text-lg">
                <i class="fas fa-user-plus mr-2"></i>
                Daftar Sekarang
            </a>
        </div>
    </section>

    <!-- =================== FOOTER SECTION =================== -->
    <footer id="about" class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem" class="h-10 w-auto">
                        <span class="text-yellow-400 font-bold text-xl">Ngadem</span>
                    </div>
                    <p class="text-gray-300 mb-6">Solusi AC premium untuk kesejukan dan kenyamanan tanpa kompromi.</p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-6">Navigasi</h3>
                    <ul class="space-y-3">
                        <li><a href="#services"
                                class="text-gray-300 hover:text-yellow-400 transition-colors">Layanan</a></li>
                        <li><a href="#gallery"
                                class="text-gray-300 hover:text-yellow-400 transition-colors">Galeri</a></li>
                        <li><a href="#about"
                                class="text-gray-300 hover:text-yellow-400 transition-colors">Tentang</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-6">Kontak</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-orange-500 mr-3"></i>
                            <a href="mailto:ngademac@gmail.com"
                                class="text-gray-300 hover:text-yellow-400 transition-colors">ngademac@gmail.com</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-orange-500 mr-3"></i>
                            <a href="tel:+6281234567890"
                                class="text-gray-300 hover:text-yellow-400 transition-colors">+62 812 3456 7890</a>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-orange-500 mr-3 mt-1"></i>
                            <span class="text-gray-300">Jl. Teknologi No. 123, Mataram</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-800 text-center">
                <p class="text-gray-400">© {{ date('Y') }} Ngadem. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <div id="lightbox" class="lightbox">
        <div class="relative max-w-4xl max-h-full p-4">
            <button class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300" id="lightbox-close">
                <i class="fas fa-times"></i>
            </button>
            <img id="lightbox-img" src="/placeholder.svg" alt="Gallery Image"
                class="max-w-full max-h-full object-contain rounded-lg">
        </div>
    </div>

    <script src="{{ asset('js/welcome.js') }}"></script>

</body>

</html>
