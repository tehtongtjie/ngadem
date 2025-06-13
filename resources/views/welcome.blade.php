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
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

</head>

<body class="antialiased">
    <div class="container mx-auto px-4 min-h-screen flex flex-col">
        <!-- Header -->
        @include('layouts.wel')

        <!-- Main content -->
        <main
            class="flex-grow flex items-center justify-center pt-24 pb-16 md:pt-32 md:pb-20 bg-gradient-to-b from-orange-50/50 to-transparent">
            <div class="relative px-6 py-12 md:px-8 md:py-16 rounded-3xl bg-white/30 backdrop-blur-lg shadow-2xl max-w-7xl mx-auto"
                data-aos="fade-up" data-aos-duration="1200">
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/10 to-orange-300/10 rounded-3xl"></div>
                <div class="relative max-w-6xl mx-auto text-center">
                    <h1
                        class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 text-gray-900 leading-tight drop-shadow-lg">
                        Dingin & Nyaman,
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-orange-500 inline-block transform transition-all duration-300 hover:scale-105 hover:drop-shadow-md">
                            Servis AC
                        </span>
                        Cepat Sekali Sentuh
                    </h1>
                    <p
                        class="text-base md:text-lg lg:text-xl max-w-3xl mx-auto mb-10 text-gray-700/85 leading-relaxed tracking-wide">
                        Ngadem hadir dengan layanan servis dan perbaikan AC yang cepat, profesional, dan terpercaya,
                        langsung ke lokasi Anda.
                    </p>
                    <div class="flex justify-center gap-4 md:gap-6 flex-wrap">
                        <a href="/login"
                            class="group relative bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-8 md:py-4 md:px-12 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center space-x-3 overflow-hidden">
                            <span class="relative z-10">Mulai Sekarang</span>
                            <i
                                class="fas fa-arrow-right relative z-10 transition-transform group-hover:translate-x-2"></i>
                            <div
                                class="absolute inset-0 bg-yellow-300 opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                            </div>
                        </a>
                        <a href="#about"
                            class="group relative border-2 border-yellow-400 text-yellow-500 hover:bg-yellow-400 hover:text-gray-900 font-semibold py-3 px-8 md:py-4 md:px-12 rounded-full transition-all duration-300 transform hover:scale-105 flex items-center space-x-3 overflow-hidden">
                            <span class="relative z-10">Tentang Kami</span>
                            <i class="fas fa-info-circle relative z-10 transition-transform group-hover:rotate-45"></i>
                            <div
                                class="absolute inset-0 bg-yellow-100 opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- About Section -->
        <section id="about" class="py-16 md:py-24 bg-gradient-to-b from-orange-50/20 to-transparent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-5xl font-extrabold mb-12 md:mb-16 text-center text-gray-900 drop-shadow-lg"
                    data-aos="fade-up" data-aos-duration="1200">
                    Mengapa Memilih
                    <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-orange-500">Ngadem</span>?
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="service-card relative bg-white/30 backdrop-blur-lg rounded-2xl p-8 shadow-xl border border-white/20 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
                        data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                        <div
                            class="text-5xl md:text-6xl text-yellow-400 mb-6 text-center transform transition-transform duration-300 hover:scale-110 hover:text-yellow-500">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </div>
                        <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-900 text-center">Teknisi Profesional
                        </h3>
                        <p class="text-gray-700 text-base md:text-lg leading-relaxed text-center">
                            Teknisi kami terlatih, bersertifikat, dan berpengalaman, memberikan solusi AC cepat, tepat,
                            dan terpercaya langsung di lokasi Anda.
                        </p>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-yellow-100/10 to-transparent rounded-2xl opacity-0 hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="service-card relative bg-white/30 backdrop-blur-lg rounded-2xl p-8 shadow-xl border border-white/20 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
                        data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                        <div
                            class="text-5xl md:text-6xl text-blue-400 mb-6 text-center transform transition-transform duration-300 hover:scale-110 hover:text-blue-500">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-900 text-center">Respon Cepat</h3>
                        <p class="text-gray-700 text-base md:text-lg leading-relaxed text-center">
                            Kami memahami urgensi Anda. Layanan kami cepat tanggap dan tersedia saat Anda
                            membutuhkannya.
                        </p>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-blue-100/10 to-transparent rounded-2xl opacity-0 hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="service-card relative bg-white/30 backdrop-blur-lg rounded-2xl p-8 shadow-xl border border-white/20 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
                        data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                        <div
                            class="text-5xl md:text-6xl text-green-400 mb-6 text-center transform transition-transform duration-300 hover:scale-110 hover:text-green-500">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-900 text-center">Harga Transparan</h3>
                        <p class="text-gray-700 text-base md:text-lg leading-relaxed text-center">
                            Biaya layanan yang jelas tanpa biaya tersembunyi. Estimasi disampaikan sebelum pekerjaan
                            dimulai.
                        </p>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-green-100/10 to-transparent rounded-2xl opacity-0 hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Galeri Proyek -->
        <section id="gallery" class="py-16 md:py-24 bg-gradient-to-b from-orange-50/30 to-transparent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-5xl font-extrabold mb-12 md:mb-16 text-center text-gray-900 drop-shadow-lg"
                    data-aos="fade-up" data-aos-duration="1200">
                    Galeri <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-orange-500">Proyek</span>
                    Kami
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    <div class="relative group rounded-2xl overflow-hidden bg-white/20 backdrop-blur-md shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <img src="/img/foto1.jpg" alt="Pembersihan Unit Outdoor"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-700/60 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-semibold text-sm md:text-base drop-shadow-md">Pembersihan Unit
                                Outdoor</p>
                        </div>
                        <div
                            class="absolute inset-0 border-2 border-yellow-400/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                    </div>
                    <div class="relative group rounded-2xl overflow-hidden bg-white/20 backdrop-blur-md shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100">
                        <img src="/img/foto2.jpg" alt="Perbaikan Unit Outdoor"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-700/60 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-semibold text-sm md:text-base drop-shadow-md">Perbaikan Unit
                                Outdoor</p>
                        </div>
                        <div
                            class="absolute inset-0 border-2 border-yellow-400/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                    </div>
                    <div class="relative group rounded-2xl overflow-hidden bg-white/20 backdrop-blur-md shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                        <img src="/img/foto3.jpg" alt="Instalasi AC Baru"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-700/60 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-semibold text-sm md:text-base drop-shadow-md">Instalasi AC Baru
                            </p>
                        </div>
                        <div
                            class="absolute inset-0 border-2 border-yellow-400/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                    </div>
                    <div class="relative group rounded-2xl overflow-hidden bg-white/20 backdrop-blur-md shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                        <img src="/img/foto4.jpg" alt="Isi Freon & Cek Tekanan"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-700/60 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-semibold text-sm md:text-base drop-shadow-md">Isi Freon & Cek
                                Tekanan</p>
                        </div>
                        <div
                            class="absolute inset-0 border-2 border-yellow-400/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                    </div>
                    <div class="relative group rounded-2xl overflow-hidden bg-white/20 backdrop-blur-md shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="400">
                        <img src="/img/foto5.jpg" alt="Perawatan Rutin Unit Outdoor"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-700/60 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-semibold text-sm md:text-base drop-shadow-md">Perawatan Rutin
                                Unit Outdoor</p>
                        </div>
                        <div
                            class="absolute inset-0 border-2 border-yellow-400/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                    </div>
                    <div class="relative group rounded-2xl overflow-hidden bg-white/20 backdrop-blur-md shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500">
                        <img src="/img/foto6.jpg" alt="Pembersihan AC Kantor"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-700/60 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-semibold text-sm md:text-base drop-shadow-md">Pembersihan AC
                                Kantor</p>
                        </div>
                        <div
                            class="absolute inset-0 border-2 border-yellow-400/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                    </div>
                    <div class="relative group rounded-2xl overflow-hidden bg-white/20 backdrop-blur-md shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="600">
                        <img src="/img/foto7.jpg" alt="Pengecekan Kebocoran Pipa"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-700/60 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-semibold text-sm md:text-base drop-shadow-md">Pengecekan
                                Kebocoran Pipa</p>
                        </div>
                        <div
                            class="absolute inset-0 border-2 border-yellow-400/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                    </div>
                    <div class="relative group rounded-2xl overflow-hidden bg-white/20 backdrop-blur-md shadow-lg cursor-pointer transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                        data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="700">
                        <img src="/img/foto8.jpg" alt="Pindah Unit"
                            class="object-cover w-full h-48 sm:h-56 md:h-64 transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-orange-700/60 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <p class="text-white font-semibold text-sm md:text-base drop-shadow-md">Pindah Unit</p>
                        </div>
                        <div
                            class="absolute inset-0 border-2 border-yellow-400/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
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
        <footer class="py-12 bg-transparent border-t border-gray-600 text-white mt-auto backdrop-blur-lg bg-opacity-30"
            data-aos="fade-up" data-aos-duration="1000">
            <div class="container mx-auto px-6 lg:px-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 text-center lg:text-left">
                    <!-- About Section -->
                    <div class="col-span-1 lg:col-span-1">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem"
                            class="h-14 w-auto mx-auto lg:mx-0 mb-4">
                        <p class="text-white text-sm leading-relaxed">
                            Ngadem adalah solusi terbaik untuk kenyamanan AC Anda. Dengan teknisi berpengalaman dan
                            layanan profesional, kami hadir membawa kesejukan sejati di setiap ruangan.
                        </p>
                        <p class="mt-4 text-xs text-yellow-100">
                            © {{ date('Y') }} Ngadem. Hak Cipta Dilindungi.
                        </p>
                    </div>
                    <!-- Quick Links Section -->
                    <div class="col-span-1 lg:col-span-1">
                        <h3 class="text-xl font-bold mb-4 text-white">Quick Links</h3>
                        <ul class="space-y-3 text-white text-sm">
                            <li>
                                <a href="{{ route('customer.dashboard') }}"
                                    class="hover:text-yellow-200 transition duration-300 flex items-center justify-center lg:justify-start">
                                    <i class="fas fa-arrow-right text-yellow-200 mr-2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.orders.index') }}"
                                    class="hover:text-yellow-200 transition duration-300 flex items-center justify-center lg:justify-start">
                                    <i class="fas fa-arrow-right text-yellow-200 mr-2"></i> Pesanan Anda
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.payments.index') }}"
                                    class="hover:text-yellow-200 transition duration-300 flex items-center justify-center lg:justify-start">
                                    <i class="fas fa-arrow-right text-yellow-200 mr-2"></i> Pembayaran
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.service.index') }}"
                                    class="hover:text-yellow-200 transition duration-300 flex items-center justify-center lg:justify-start">
                                    <i class="fas fa-arrow-right text-yellow-200 mr-2"></i> Layanan Kami
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Contact Section -->
                    <div class="col-span-1 lg:col-span-1">
                        <h3 class="text-xl font-bold mb-4 text-white">Kontak Kami</h3>
                        <ul class="space-y-3 text-white text-sm">
                            <li>
                                <a href="mailto:info@ngadem.com"
                                    class="hover:text-yellow-200 transition duration-300 flex items-center justify-center lg:justify-start">
                                    <i class="fas fa-envelope text-yellow-200 mr-2"></i> ngademac@gmail.com
                                </a>
                            </li>
                            <li>
                                <a href="tel:+6281234567890"
                                    class="hover:text-yellow-200 transition duration-300 flex items-center justify-center lg:justify-start">
                                    <i class="fas fa-phone-alt text-yellow-200 mr-2"></i> +62 812 3456 7890
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="hover:text-yellow-200 transition duration-300 flex items-center justify-center lg:justify-start">
                                    <i class="fas fa-map-marker-alt text-yellow-200 mr-2"></i> Jl. Teknologi No. 123,
                                    Mataram
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Social Media Section -->
                    <div class="col-span-1 lg:col-span-1">
                        <h3 class="text-xl font-bold mb-4 text-white">Ikuti Kami</h3>
                        <div class="flex justify-center lg:justify-start space-x-4 text-3xl">
                            <a href="#" class="text-yellow-200 hover:text-white transition-colors duration-300"
                                aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-yellow-200 hover:text-white transition-colors duration-300"
                                aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="text-yellow-200 hover:text-white transition-colors duration-300"
                                aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-yellow-200 hover:text-white transition-colors duration-300"
                                aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Footer Bottom -->
                <div class="mt-10 pt-6 border-t border-yellow-700 text-center">
                    <div class="text-sm text-yellow-100 space-x-4">
                        <a href="#" class="hover:text-white transition duration-300">Kebijakan Privasi</a>
                        <span class="text-yellow-200">|</span>
                        <a href="#" class="hover:text-white transition duration-300">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/welcome.js') }}"></script>
</body>

</html>
