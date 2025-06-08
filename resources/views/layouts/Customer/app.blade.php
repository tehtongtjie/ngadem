<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - Ngadem</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS (Animation on Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Inline Styling -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #FFEDD5 0%, #FDD87F 50%, #FB923C 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #333;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .glass-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        /* Styling untuk header yang menyusut */
        #main-header.shrink {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
            border-radius: 9999px !important;
            background: rgba(255, 255, 255, 0.4) !important;
            backdrop-filter: blur(15px) !important;
            box-shadow: 0 8px 30px rgba(251, 146, 60, 0.4) !important;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        #main-header.shrink img#header-logo-img {
            height: 36px !important;
            transition: height 0.3s ease-in-out;
        }

        #main-header.shrink span#header-logo-text {
            font-size: 1.25rem !important;
            transition: font-size 0.3s ease-in-out;
        }

        #main-header.shrink nav a {
            font-size: 0.95rem !important;
        }

        /* Custom scrollbar untuk notifikasi */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(251, 146, 60, 0.7);
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #FB923C;
        }

        /* Hover effect for action buttons */
        .action-button {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .action-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transition: width 0.4s ease-in-out, height 0.4s ease-in-out, top 0.4s ease-in-out, left 0.4s ease-in-out;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .action-button:hover::before {
            width: 300%;
            height: 300%;
            top: 50%;
            left: 50%;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container mx-auto px-4 min-h-screen flex flex-col">
        <!-- Include Navbar -->
        @include('layouts.customer.navbar')

        <!-- Main Content -->
        <main class="container py-10">
            @yield('content') <!-- Konten dinamis halaman utama -->
        </main>

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
                            &copy; {{ date('Y') }} Ngadem. Hak Cipta Dilindungi.
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


        <script>
            // Initialize AOS (Animate on Scroll)
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100,
                delay: 50
            });

            // Shrinking header on scroll
            window.addEventListener('scroll', function() {
                const header = document.getElementById('main-header');
                if (window.scrollY > 80) {
                    header.classList.add('shrink');
                } else {
                    header.classList.remove('shrink');
                }
            });
        </script>
</body>

</html>
