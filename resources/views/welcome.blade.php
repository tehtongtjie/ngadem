<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Selamat Datang di Ngadem - Solusi AC Profesional</title>

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #FFEDD5 0%, #FB923C 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -2px rgba(0, 0, 0, 0.06);
        }

        .hero-gradient {
            background: linear-gradient(rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(251, 146, 60, 0.5),
                0 4px 6px -2px rgba(251, 146, 60, 0.3);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .service-card {
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow:
                0 20px 25px -5px rgba(251, 146, 60, 0.4),
                0 10px 10px -5px rgba(251, 146, 60, 0.2);
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #f59e0b;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Header shrink effect on scroll */
        header.shrink {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
            border-radius: 9999px !important;
            /* fully rounded */
            background: rgba(255, 255, 255, 0.3) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 30px rgba(251, 146, 60, 0.4) !important;
        }

        header.shrink img#header-logo-img {
            height: 32px !important;
        }

        header.shrink span#header-logo-text {
            font-size: 1.125rem !important;
            /* text-lg */
        }

        header.shrink nav a {
            font-size: 0.875rem !important;
            /* text-sm */
        }
    </style>
</head>

<body class="antialiased">
    <div class="container mx-auto px-4 min-h-screen flex flex-col">
        <!-- Header -->
        <header id="main-header"
            class="fixed top-0 left-0 right-0 z-50 bg-transparent transition-all duration-300 py-4 px-6 rounded-b-2xl">
            <div class="container mx-auto max-w-7xl flex justify-between items-center">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem"
                        class="h-12 w-auto transition-all duration-300" id="header-logo-img" />
                    <span
                        class="text-white font-extrabold text-3xl tracking-wide drop-shadow-lg select-none hidden sm:inline-block"
                        id="header-logo-text">
                    </span>
                </a>

                <nav id="header-nav-links" class="flex space-x-10 text-white font-semibold">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="nav-link hover:text-yellow-400 transition duration-300">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="nav-link hover:text-yellow-400 transition duration-300">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="nav-link hover:text-yellow-400 transition duration-300">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </div>
        </header>

        <!-- Main content -->
        <main class="flex-grow flex items-center justify-center pt-32 pb-20">
            <div class="hero-gradient px-8 py-10" data-aos="fade-up" data-aos-duration="1000">
                <div class="max-w-6xl mx-auto text-center">
                    <h1 class="text-5xl md:text-7xl font-extrabold mb-6 text-gray-900 leading-tight drop-shadow-md">
                        Dingin & Nyaman, <span
                            class="text-yellow-500 inline-block transform hover:scale-105 transition-transform duration-300 floating">Servis
                            AC</span>
                        Cepat Hanya Dengan Sekali Sentuh.
                    </h1>

                    <p class="text-lg md:text-xl max-w-4xl mx-auto mb-12 text-gray-700/90 leading-relaxed">
                        Ngadem menyediakan layanan service dan perbaikan AC terpercaya, cepat, dan profesional langsung
                        ke lokasi Anda.
                    </p>
                    <div class="flex justify-center gap-6 flex-wrap">
                        <a href="{{ route('login') }}"
                            class="group bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-4 px-12 rounded-full shadow-xl transition duration-300 transform hover:scale-105 ease-in-out flex items-center space-x-3">
                            <span>Mulai Sekarang</span>
                            <i class="fas fa-arrow-right transition-transform group-hover:translate-x-2"></i>
                        </a>
                        <a href="#about"
                            class="group border-2 border-yellow-400 text-yellow-500 hover:bg-yellow-400 hover:text-gray-900 font-semibold py-4 px-12 rounded-full transition duration-300 transform hover:scale-105 ease-in-out flex items-center space-x-3">
                            <span>Tentang Kami</span>
                            <i class="fas fa-info-circle transition-transform group-hover:rotate-12"></i>
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- About Section -->
        <section id="about" class="py-20">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-16 text-center text-gray-900 drop-shadow-md"
                    data-aos="fade-up" data-aos-duration="1000">
                    Mengapa Pilih <span class="text-yellow-500">Ngadem</span>?
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="service-card glass-effect rounded-3xl p-8" data-aos="fade-up" data-aos-delay="100"
                        data-aos-duration="1000">
                        <div
                            class="text-6xl text-yellow-500 mb-6 text-center transform transition-transform hover:scale-110">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900 text-center">Teknisi Profesional</h3>
                        <p class="text-gray-700 leading-relaxed text-center">
                            Teknisi kami terlatih, bersertifikat, dan berpengalaman, siap membantu Anda dengan solusi AC
                            yang cepat dan tepat.
                        </p>
                    </div>

                    <div class="service-card glass-effect rounded-3xl p-8" data-aos="fade-up" data-aos-delay="200"
                        data-aos-duration="1000">
                        <div
                            class="text-6xl text-yellow-500 mb-6 text-center transform transition-transform hover:scale-110">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900 text-center">Layanan Cepat & Tepat</h3>
                        <p class="text-gray-700 leading-relaxed text-center">
                            Kami berkomitmen memberikan layanan responsif sesuai jadwal, memastikan AC Anda berfungsi
                            optimal kembali tanpa penundaan.
                        </p>
                    </div>

                    <div class="service-card glass-effect rounded-3xl p-8" data-aos="fade-up" data-aos-delay="300"
                        data-aos-duration="1000">
                        <div
                            class="text-6xl text-yellow-500 mb-6 text-center transform transition-transform hover:scale-110">
                            <i class="fa-solid fa-tag"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900 text-center">Harga Transparan</h3>
                        <p class="text-gray-700 leading-relaxed text-center">
                            Tidak ada biaya tersembunyi. Semua biaya jelas dan transparan sejak awal, memberikan Anda
                            ketenangan pikiran.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Galeri Proyek -->
        <section id="gallery" class="py-20">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-12 text-center text-orange-800 drop-shadow-md"
                    data-aos="fade-up" data-aos-duration="1000">
                    Galeri <span class="text-yellow-600">Proyek</span> Kami
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    <div class="relative group rounded-xl shadow-lg overflow-hidden cursor-pointer" data-aos="zoom-in"
                        data-aos-duration="1000">
                        <img src="{{ asset('img/foto1.jpg') }}" alt="Pembersihan AC Indoor"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-500 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-800/70 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-medium text-sm">Pembersihan AC Indoor</p>
                        </div>
                    </div>

                    <div class="relative group rounded-xl shadow-lg overflow-hidden cursor-pointer" data-aos="zoom-in"
                        data-aos-duration="1000" data-aos-delay="100">
                        <img src="{{ asset('img/foto2.jpg') }}" alt="Perbaikan Unit Outdoor"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-500 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-800/70 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-medium text-sm">Perbaikan Unit Outdoor</p>
                        </div>
                    </div>

                    <div class="relative group rounded-xl shadow-lg overflow-hidden cursor-pointer" data-aos="zoom-in"
                        data-aos-duration="1000" data-aos-delay="200">
                        <img src="{{ asset('img/foto3.jpg') }}" alt="Instalasi AC Baru"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-500 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-800/70 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-medium text-sm">Instalasi AC Baru</p>
                        </div>
                    </div>

                    <div class="relative group rounded-xl shadow-lg overflow-hidden cursor-pointer" data-aos="zoom-in"
                        data-aos-duration="1000" data-aos-delay="300">
                        <img src="{{ asset('img/foto4.jpg') }}" alt="Isi Freon & Cek Tekanan"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-500 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-800/70 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-medium text-sm">Isi Freon & Cek Tekanan</p>
                        </div>
                    </div>

                    <div class="relative group rounded-xl shadow-lg overflow-hidden cursor-pointer" data-aos="zoom-in"
                        data-aos-duration="1000" data-aos-delay="400">
                        <img src="{{ asset('img/foto5.jpg') }}" alt="Perawatan Rutin AC Kantor"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-500 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-800/70 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-medium text-sm">Perawatan Rutin AC Kantor</p>
                        </div>
                    </div>

                    <div class="relative group rounded-xl shadow-lg overflow-hidden cursor-pointer" data-aos="zoom-in"
                        data-aos-duration="1000" data-aos-delay="500">
                        <img src="{{ asset('img/foto6.jpg') }}" alt="Penggantian Komponen AC"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-500 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-800/70 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-medium text-sm">Penggantian Komponen AC</p>
                        </div>
                    </div>

                    <div class="relative group rounded-xl shadow-lg overflow-hidden cursor-pointer" data-aos="zoom-in"
                        data-aos-duration="1000" data-aos-delay="600">
                        <img src="{{ asset('img/foto7.jpg') }}" alt="Pembersihan Kondensor AC"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-500 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-800/70 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-medium text-sm">Pembersihan Kondensor AC</p>
                        </div>
                    </div>

                    <div class="relative group rounded-xl shadow-lg overflow-hidden cursor-pointer" data-aos="zoom-in"
                        data-aos-duration="1000" data-aos-delay="700">
                        <img src="{{ asset('img/foto8.jpg') }}" alt="Pengecekan Kebocoran Pipa"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-500 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-800/70 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-medium text-sm">Pengecekan Kebocoran Pipa</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section
            class="py-20 bg-orange-600 text-white text-center rounded-3xl mx-auto w-full max-w-5xl my-10 shadow-2xl"
            data-aos="fade-up" data-aos-duration="1000">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6 drop-shadow-md">Siap Ngadem?</h2>
            <p class="text-xl md:text-2xl mb-10 max-w-3xl mx-auto leading-relaxed">
                Jangan biarkan AC Anda bermasalah. Dapatkan layanan terbaik dari teknisi kami sekarang juga!
            </p>
            <a href="{{ route('register') }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-4 px-12 rounded-full shadow-xl transition duration-300 transform hover:scale-105 ease-in-out inline-flex items-center space-x-3">
                <span>Daftar Sekarang</span>
                <i class="fas fa-user-plus transition-transform group-hover:translate-x-1"></i>
            </a>
        </section>

        <!-- Footer -->
        <footer class="py-8 text-center mt-auto" data-aos="fade-up" data-aos-duration="1000">
            <div class="glass-effect rounded-2xl py-6 px-4 text-gray-700">
                <p>&copy; {{ date('Y') }} Ngadem. Hak Cipta Dilindungi.</p>
                <div class="mt-4 space-x-5 text-2xl">
                    <a href="#" class="text-gray-700 hover:text-yellow-500 transition-colors duration-300">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-yellow-500 transition-colors duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-yellow-500 transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-yellow-500 transition-colors duration-300">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        window.addEventListener('scroll', function() {
            const header = document.getElementById('main-header');
            if (window.scrollY > 50) {
                header.classList.add('shrink');
            } else {
                header.classList.remove('shrink');
            }
        });
    </script>
</body>

</html>
