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
    <link rel="stylesheet" href="{{ asset('css/navbar-customer.css') }}">
</head>

<body class="bg-gradient-to-br from-orange-50 to-orange-100 font-sans text-gray-900 min-h-screen">
    <header class="navbar fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
            <a href="{{ route('customer.dashboard') }}" class="flex items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Grok ServicePro Logo"
                    class="logo-image h-10 sm:h-12 w-auto">
            </a>

            <button id="mobile-menu-button"
                class="lg:hidden p-2 rounded-lg text-white hover:bg-orange-400/20 focus:outline-none focus:ring-2 focus:ring-orange-400 transition-colors duration-200"
                aria-label="Toggle mobile menu" aria-expanded="false">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <nav class="hidden lg:flex items-center space-x-6 text-base font-medium">
                <a href="{{ route('customer.dashboard') }}"
                    class="text-white hover:text-orange-400 hover:underline transition-colors duration-200 py-2">Dashboard</a>
                <a href="{{ route('customer.orders.index') }}"
                    class="text-white hover:text-orange-400 hover:underline transition-colors duration-200 py-2">Pesanan</a>
                <a href="{{ route('customer.payments.index') }}"
                    class="text-white hover:text-orange-400 hover:underline transition-colors duration-200 py-2">Pembayaran</a>
                <a href="{{ route('customer.service.index') }}"
                    class="text-white hover:text-orange-400 hover:underline transition-colors duration-200 py-2">Layanan</a>

                <div class="relative group">
                    <button id="profile-dropdown-button"
                        class="flex items-center space-x-2 text-white hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-400 rounded-lg px-3 py-2 transition-colors duration-200"
                        aria-expanded="false" aria-haspopup="true" aria-label="Profile menu">
                        <i class="fas fa-user-circle text-lg"></i>
                        <span>Profil</span>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-orange-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="profile-dropdown-menu"
                        class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg ring-1 ring-gray-200 overflow-hidden"
                        role="menu" aria-orientation="vertical" aria-labelledby="profile-dropdown-button">
                        <a href="{{ route('customer.profile.index') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200"
                            role="menuitem">
                            <i class="fas fa-user mr-2 text-orange-500"></i> Profil Anda
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200"
                                role="menuitem">
                                <i class="fas fa-sign-out-alt mr-2 text-red-500"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="h-16 lg:h-20"></div>

    <div id="mobile-nav"
        class="fixed top-0 left-0 w-full bg-white shadow-2xl z-40 transform -translate-y-full transition-transform duration-500 ease-in-out lg:hidden rounded-b-xl overflow-y-auto max-h-screen">
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
        <nav class="flex flex-col space-y-1 p-6 text-gray-800 text-base font-medium">
            <a href="{{ route('customer.dashboard') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                <i class="fas fa-home mr-3 text-orange-500"></i> Dashboard
            </a>
            <a href="{{ route('customer.orders.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                <i class="fas fa-box-open mr-3 text-green-500"></i> Pesanan
            </a>
            <a href="{{ route('customer.payments.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                <i class="fas fa-credit-card mr-3 text-purple-500"></i> Pembayaran
            </a>
            <a href="{{ route('customer.service.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                <i class="fas fa-concierge-bell mr-3 text-yellow-500"></i> Layanan
            </a>
            <a href="{{ route('customer.profile.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                <i class="fas fa-user-alt mr-3 text-orange-500"></i> Profil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="flex items-center w-full py-3 px-4 rounded-lg bg-red-500 text-white hover:bg-red-600 transition-colors duration-200 font-medium">
                    <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                </button>
            </form>
        </nav>
    </div>
    <script src="{{ asset('js/navbar.js') }}"></script>
</body>

</html>
