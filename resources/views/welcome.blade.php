{{-- resources/views/welcome.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Ngadem - Solusi AC Profesional</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta4oJ3B8/r2nBfP10gYvR8yV+Y5x2eR2zW1B/E1f6c7E3gA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #1F2937;
            background: linear-gradient(135deg, #1F2937 0%, #111827 30%, #000000 60%, #F97316 100%);
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styles */
        .navbar {
            transition: background-color 0.3s ease, backdrop-filter 0.3s ease, box-shadow 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(17, 24, 39, 0.95);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            position: relative;
            font-size: 1rem;
            font-weight: 500;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background: #FBBF24;
            /* Yellow-400 */
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Mobile Menu (Slide-from-Right) */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            width: 75%;
            max-width: 320px;
            background: rgba(17, 24, 39, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            z-index: 999;
            transform: translateX(100%);
            /* Sembunyikan di luar layar kanan */
            transition: transform 0.4s ease-in-out;
            display: flex;
            flex-direction: column;
            padding: 2rem;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
        }

        .mobile-menu.open {
            transform: translateX(0);
            /* Geser ke dalam layar */
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            width: 100%;
            /* Changed from 100vw to 100% for better container adherence */
            min-height: 100vh;
            /* Ensure it takes full viewport height */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            /* Text color for hero content */
            background-size: cover;
            background-position: center;
            padding-top: 6rem;
            /* Adjust for fixed navbar */
            padding-bottom: 6rem;
            /* Add padding bottom */
        }

        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        /* Hero Gradient Overlay */
        .hero-gradient-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom right, rgba(249, 115, 22, 0.7), rgba(251, 191, 36, 0.7));
            /* Orange-500 to Yellow-500 */
            z-index: -1;
        }

        /* Particle Overlay */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        /* Service Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        /* Testimonial Carousel */
        .carousel {
            position: relative;
            overflow: hidden;
        }

        .carousel-items {
            display: flex;
            transition: transform 0.6s ease-in-out;
            width: fit-content;
        }

        .carousel-item {
            min-width: 100%;
        }

        .carousel-thumbs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .carousel-thumb {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s, border 0.3s;
            border: 2px solid transparent;
        }

        .carousel-thumb.active {
            border-color: #F59E0B;
            /* Yellow-500 */
            opacity: 1;
        }

        /* Gallery Masonry */
        .masonry {
            column-count: 3;
            column-gap: 1.5rem;
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .masonry-item:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .masonry-item .overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(249, 115, 22, 0.7);
            /* Orange-600/70 */
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .masonry-item:hover .overlay {
            opacity: 1;
        }

        /* Glowing CTA Button */
        .cta-button {
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3), transparent);
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.6s ease;
            z-index: -1;
        }

        .cta-button:hover::before {
            transform: translate(-50%, -50%) scale(1);
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {

            /* <= lg breakpoint */
            .masonry {
                column-count: 2;
            }
        }

        @media (max-width: 768px) {

            /* <= md breakpoint */
            .hero-video {
                display: none;
            }

            .masonry {
                column-count: 1;
            }

            .carousel-thumbs {
                display: none;
            }
        }
    </style>
</head>

<body class="antialiased font-inter">
    <div class="min-h-screen flex flex-col">
        <header id="main-header" class="fixed top-0 left-0 right-0 z-50 bg-transparent navbar py-4 px-6">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem" class="h-12 w-auto" id="header-logo-img">
                    <span class="text-white font-bold text-2xl" id="header-logo-text">Ngadem</span>
                </a>
                <nav class="hidden md:flex items-center space-x-6 text-white text-base font-medium">
                    <a href="#services" class="nav-link hover:text-yellow-400 transition duration-300">Layanan</a>
                    <a href="#gallery" class="nav-link hover:text-yellow-400 transition duration-300">Galeri</a>
                    <a href="#about" class="nav-link hover:text-yellow-400 transition duration-300">Tentang</a>
                    @auth
                        <a href="{{ route('customer.dashboard') }}"
                            class="nav-link hover:text-yellow-400 transition duration-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="nav-link hover:text-yellow-400 transition duration-300">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 py-2.5 px-6 rounded-lg transition duration-300 shadow-md">Daftar</a>
                        @endif
                    @endauth
                </nav>
                <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            <div id="mobile-menu"
                class="mobile-menu fixed top-0 right-0 h-full w-2/3 bg-gray-900 z-999 shadow-lg flex flex-col items-start p-6 space-y-4 text-white text-base font-medium">
                <button id="mobile-menu-close" class="self-end text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <a href="#services" class="nav-link hover:text-yellow-400 transition duration-200 block">Layanan</a>
                <a href="#gallery" class="nav-link hover:text-yellow-400 transition duration-200 block">Galeri</a>
                <a href="#about" class="nav-link hover:text-yellow-400 transition duration-200 block">Tentang</a>
                @auth
                    <a href="{{ route('customer.dashboard') }}"
                        class="nav-link hover:text-yellow-400 transition duration-200 block">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="nav-link hover:text-yellow-400 transition duration-200 block">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 py-2.5 px-6 rounded-lg transition duration-200 text-sm w-full text-center mt-4">Daftar</a>
                    @endif
                @endauth
            </div>
        </header>

        <main class="flex-grow flex items-center justify-center pt-24 pb-20 hero-section"
            style="background-image: url('{{ asset('img/foto1.jpg') }}'); background-size: cover; background-position: center;">
            <div class="hero-gradient-overlay"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white" data-aos="zoom-in"
                data-aos-duration="1200">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight drop-shadow-md">
                    Kesejukan Elite dengan <span class="text-yellow-300">Ngadem</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 max-w-2xl mx-auto font-light">
                    Layanan AC profesional dengan teknologi terdepan untuk kenyamanan tanpa batas.
                </p>
                <a href="{{ route('register') }}"
                    class="cta-button inline-flex items-center bg-gradient-to-r from-yellow-500 to-orange-500 text-gray-900 font-bold py-4 px-12 rounded-xl text-xl transition-all duration-300 hover:shadow-xl"
                    aria-label="Get Started">
                    <i class="fas fa-sun mr-2"></i> Mulai Sekarang
                </a>
            </div>
        </main>

        <section id="services" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-8">
                <h2 class="text-4xl font-bold text-gray-900 mb-16 text-center" data-aos="fade-up"
                    data-aos-duration="1000">
                    Layanan Unggulan Kami
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ([['icon' => 'fa-broom', 'title' => 'Pembersihan AC', 'desc' => 'Udara segar dengan pembersihan menyeluruh.'], ['icon' => 'fa-tools', 'title' => 'Perbaikan AC', 'desc' => 'Solusi cepat untuk semua masalah AC.'], ['icon' => 'fa-snowflake', 'title' => 'Isi Freon', 'desc' => 'Pendinginan optimal setiap saat.'], ['icon' => 'fa-cogs', 'title' => 'Instalasi AC', 'desc' => 'Pemasangan presisi untuk performa terbaik.']] as $index => $service)
                        <div class="glass-card rounded-2xl p-8 text-center border border-gray-200 shadow-lg relative group"
                            data-aos="flip-up" data-aos-delay="{{ $index * 150 }}" data-aos-duration="1000">
                            <i
                                class="fas {{ $service['icon'] }} text-yellow-500 text-5xl mb-6 transform group-hover:scale-110 transition-transform duration-300"></i>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4">{{ $service['title'] }}</h3>
                            <p class="text-base text-gray-700">{{ $service['desc'] }}</p>
                            <span
                                class="tooltip absolute bg-gray-900 text-white text-sm rounded py-1 px-3 -top-10 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                {{ $service['title'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="testimonials" class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-8">
                <h2 class="text-4xl font-bold text-gray-900 mb-16 text-center" data-aos="fade-up"
                    data-aos-duration="1000">
                    Cerita Pelanggan Kami
                </h2>
                <div class="carousel relative">
                    <div class="carousel-items" id="carousel">
                        @foreach ([['name' => 'Budi Santoso', 'text' => 'Pelayanan luar biasa! AC saya kembali dingin dalam waktu singkat.', 'thumb' => 'thumb1.jpg'], ['name' => 'Siti Aminah', 'text' => 'Teknisi profesional dan harga transparan. Ngadem is the best!', 'thumb' => 'thumb2.jpg'], ['name' => 'Andi Wijaya', 'text' => 'Pembersihan AC sangat rapi, udara jadi segar!', 'thumb' => 'thumb3.jpg'], ['name' => 'Rina Lestari', 'text' => 'Instalasi AC baru dilakukan dengan presisi tinggi.', 'thumb' => 'thumb4.jpg']] as $index => $testimonial)
                            <div class="carousel-item text-center p-8">
                                <div class="bg-white rounded-2xl p-10 border border-gray-200 max-w-2xl mx-auto shadow-lg"
                                    data-aos="fade-up" data-aos-duration="1000">
                                    <p class="text-lg text-gray-600 mb-6 italic">“{{ $testimonial['text'] }}”</p>
                                    <p class="text-xl font-semibold text-gray-900">{{ $testimonial['name'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="carousel-thumbs">
                        @foreach (['thumb1.jpg', 'thumb2.jpg', 'thumb3.jpg', 'thumb4.jpg'] as $index => $thumb)
                            <img src="{{ asset('img/' . $thumb) }}" alt="Thumbnail {{ $index + 1 }}"
                                class="carousel-thumb {{ $index === 0 ? 'active' : '' }}"
                                data-index="{{ $index }}">
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="gallery" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-8">
                <h2 class="text-4xl font-bold text-gray-900 mb-16 text-center" data-aos="fade-up"
                    data-aos-duration="1000">
                    Galeri Proyek Kami
                </h2>
                <div class="masonry">
                    @foreach ([['img' => 'foto1.jpg', 'title' => 'Pembersihan Unit'], ['img' => 'foto2.jpg', 'title' => 'Perbaikan AC'], ['img' => 'foto3.jpg', 'title' => 'Instalasi Baru'], ['img' => 'foto4.jpg', 'title' => 'Isi Freon'], ['img' => 'foto5.jpg', 'title' => 'Perawatan Rutin'], ['img' => 'foto6.jpg', 'title' => 'Pengecekan Pipa']] as $index => $photo)
                        <div class="masonry-item rounded-2xl border border-gray-200 shadow-lg relative group"
                            data-aos="zoom-in" data-aos-delay="{{ $index * 150 }}" data-aos-duration="1000">
                            <img src="{{ asset('img/' . $photo['img']) }}" alt="{{ $photo['title'] }}"
                                class="object-cover w-full h-auto transition duration-300">
                            <div
                                class="absolute inset-0 bg-yellow-500/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <span class="text-gray-900 text-lg font-semibold">{{ $photo['title'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="lightbox" id="lightbox">
                    <img class="lightbox-img" id="lightbox-img" src="" alt="Lightbox Image">
                </div>
            </div>
        </section>

        <section class="py-24 bg-gradient-to-r from-yellow-500 to-orange-500 text-gray-900 text-center">
            <div class="max-w-5xl mx-auto px-6 sm:px-8 lg:px-8" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="text-4xl font-bold mb-8">Raih Kesejukan Bersama Ngadem!</h2>
                <p class="text-xl mb-10 max-w-3xl mx-auto">
                    Daftar sekarang untuk layanan AC premium dari tim profesional kami.
                </p>
                <a href="{{ route('register') }}"
                    class="cta-button inline-flex items-center bg-white hover:bg-gray-100 text-yellow-500 font-bold py-4 px-12 rounded-xl text-xl transition-all duration-300 hover:shadow-2xl"
                    aria-label="Daftar Sekarang">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                </a>
            </div>
        </section>

        <footer class="py-16 bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="md:col-span-2">
                        <div class="flex items-center justify-center md:justify-start space-x-3 mb-6">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem" class="h-12 w-auto">
                            <span class="text-yellow-500 font-bold text-2xl">Ngadem</span>
                        </div>
                        <p class="text-base text-gray-400">
                            Solusi AC premium untuk kesejukan dan kenyamanan tanpa kompromi.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-6 text-white">Navigasi</h3>
                        <ul class="space-y-3 text-base text-gray-400">
                            <li><a href="#services" class="hover:text-yellow-500 transition duration-300">Layanan</a>
                            </li>
                            <li><a href="#testimonials"
                                    class="hover:text-yellow-500 transition duration-300">Testimoni</a></li>
                            <li><a href="#gallery" class="hover:text-yellow-500 transition duration-300">Galeri</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-6 text-white">Kontak</h3>
                        <ul class="space-y-3 text-base text-gray-400">
                            <li><a href="mailto:ngademac@gmail.com"
                                    class="hover:text-yellow-500 transition duration-300">ngademac@gmail.com</a></li>
                            <li><a href="tel:+6281234567890" class="hover:text-yellow-500 transition duration-300">+62
                                    812 3456 7890</a></li>
                            <li>Jl. Teknologi No. 123, Mataram</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-gray-800 text-center text-sm text-gray-400">
                    <p>© {{ date('Y') }} Ngadem. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-out-quart',
            once: true,
            offset: 120
        });

        // Particle Effect
        const canvas = document.querySelector('.particles');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        const particlesArray = [];
        const particleCount = 100;

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 3 + 1;
                this.speedX = Math.random() * 0.5 - 0.25;
                this.speedY = Math.random() * 0.5 - 0.25;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.size > 0.2) this.size -= 0.01;
                if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }
            draw() {
                ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            for (let i = 0; i < particleCount; i++) {
                particlesArray.push(new Particle());
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particlesArray.forEach(particle => {
                particle.update();
                particle.draw();
            });
            requestAnimationFrame(animateParticles);
        }

        initParticles();
        animateParticles();

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        // Carousel Navigation
        const carousel = document.getElementById('carousel');
        const thumbs = document.querySelectorAll('.carousel-thumb');
        let currentIndex = 0;

        function updateCarousel() {
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
            thumbs.forEach((thumb, index) => {
                thumb.classList.toggle('active', index === currentIndex);
            });
        }

        thumbs.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                currentIndex = index;
                updateCarousel();
            });
        });

        setInterval(() => {
            currentIndex = (currentIndex + 1) % 4;
            updateCarousel();
        }, 6000);

        // Lightbox Gallery
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const galleryItems = document.querySelectorAll('.masonry-item');

        galleryItems.forEach(item => {
            item.addEventListener('click', () => {
                lightboxImg.src = item.dataset.src;
                lightbox.classList.add('active');
            });
        });

        lightbox.addEventListener('click', () => {
            lightbox.classList.remove('active');
        });
    </script>
</body>

</html>
