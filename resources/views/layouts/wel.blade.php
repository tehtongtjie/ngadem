<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlalTjsz8h3f8eM1P8sA3j1E2c3J9r6+Z3zN6b5+9F1z5O5y6t5+0+7u7s4P0+7u7s4P0+7u7s4P0+7u7s4P0+7u7s4P0="
        crossorigin="anonymous" referrerpolicy="no-referrer" async>
    <link rel="stylesheet" href="{{ asset('css/navbar-landpag.css') }}">
</head>

<body class="bg-gradient-to-br from-orange-50 to-orange-100 font-sans text-gray-900 min-h-screen">
    <header class="navbar fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2">
                <img src="/img/logo.png" alt="Ngadem Logo"
                    class="h-10 sm:h-12 w-auto transition-transform duration-300 hover:scale-105">
            </a>

            <button id="mobile-menu-button"
                class="lg:hidden p-2 rounded-lg text-white hover:bg-orange-500/20 focus:outline-none focus:ring-2 focus:ring-orange-400 transition-colors duration-200"
                aria-label="Toggle mobile menu" aria-expanded="false">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <nav class="hidden lg:flex items-center space-x-6 text-base font-medium">
                <a href="/login"
                    class="text-white bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-lg transition-colors duration-200">Login</a>
                <a href="/register"
                    class="text-orange-500 bg-white hover:bg-orange-100 px-4 py-2 rounded-lg transition-colors duration-200">Register</a>
            </nav>
        </div>
    </header>

    <!-- Mobile Navigation -->
    <div id="mobile-nav"
        class="fixed top-0 left-0 w-full bg-white shadow-2xl z-40 transform -translate-y-full lg:hidden rounded-b-xl overflow-y-auto max-h-screen">
        <div class="flex justify-between items-center px-6 py-4 bg-orange-600 text-white">
            <span class="text-lg font-bold">Menu</span>
            <button id="mobile-menu-close-button"
                class="p-2 rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-white transition-colors duration-200"
                aria-label="Close mobile menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex flex-col space-y-2 p-6 text-gray-800 text-base font-medium">
            <a href="/login"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                <i class="fas fa-sign-in-alt mr-3 text-orange-500"></i> Login
            </a>
            <a href="/register"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                <i class="fas fa-user-plus mr-3 text-green-500"></i> Register
            </a>
        </nav>
    </div>

    <script src="{{ asset('js/navbar-landpag.js') }}"></script>
</body>

</html>
