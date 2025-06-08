<header id="main-header"
    class="fixed top-0 left-0 right-0 z-50 bg-transparent transition-all duration-300 py-4 px-6 rounded-b-2xl">
    <div class="container mx-auto max-w-7xl flex justify-between items-center">
        <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem" class="h-12 w-auto transition-all duration-300"
                id="header-logo-img" />
        </a>

        @auth
            <button id="mobile-menu-button" class="lg:hidden text-white focus:outline-none" aria-label="Open menu"
                type="button">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <nav id="header-nav-links" class="hidden lg:flex space-x-8 text-white font-semibold items-center">
                <a href="{{ route('customer.dashboard') }}" class="nav-link hover:text-yellow-400 transition duration-300">
                    Dashboard
                </a>
                <a href="{{ route('customer.orders.index') }}"
                    class="nav-link hover:text-yellow-400 transition duration-300">
                    Pesanan
                </a>
                <a href="{{ route('customer.payments.index') }}"
                    class="nav-link hover:text-yellow-400 transition duration-300">
                    Pembayaran
                </a>
                <a href="{{ route('customer.service.index') }}"
                    class="nav-link hover:text-yellow-400 transition duration-300">
                    Layanan
                </a>

                <div class="relative group">
                    <button id="profile-dropdown-button"
                        class="nav-link hover:text-yellow-400 transition duration-300 flex items-center space-x-2 focus:outline-none"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 2a5 5 0 100 10 5 5 0 000-10zM3 18a7 7 0 0114 0H3z" />
                        </svg>
                        <span>{{ Auth::user()->name ?? 'Profil' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 ml-1 transform transition-transform duration-200" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" id="profile-dropdown-arrow">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="profile-dropdown-menu"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 invisible transition-all duration-200 transform scale-95 origin-top-right">
                        <a href="{{ route('customer.profile.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Pengaturan
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <nav id="mobile-nav"
                class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-95 z-[100] hidden flex-col items-center justify-center space-y-8 text-white text-3xl py-8 transition-opacity duration-300 ease-in-out opacity-0 pointer-events-none">

                <button id="mobile-menu-close-button" class="absolute top-6 right-6 text-white focus:outline-none"
                    aria-label="Close menu" type="button">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>

                <a href="{{ route('customer.dashboard') }}"
                    class="hover:text-yellow-400 transition duration-300 block w-full text-center py-2">Dashboard</a>
                <a href="{{ route('customer.orders.index') }}"
                    class="hover:text-yellow-400 transition duration-300 block w-full text-center py-2">Pesanan</a>
                <a href="{{ route('customer.payments.index') }}"
                    class="hover:text-yellow-400 transition duration-300 block w-full text-center py-2">Pembayaran</a>
                <a href="{{ route('customer.service.index') }}"
                    class="hover:text-yellow-400 transition duration-300 block w-full text-center py-2">Layanan</a>
                <a href="{{ route('customer.profile.index') }}"
                    class="hover:text-yellow-400 transition duration-300 block w-full text-center py-2">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="w-full flex justify-center mt-6"
                    aria-label="Logout" title="Logout">
                    @csrf
                    <button type="submit"
                        class="py-3 px-8 bg-yellow-400 text-gray-900 rounded-full font-semibold hover:bg-yellow-500 transition duration-300 text-xl shadow-lg">Logout</button>
                </form>
            </nav>
        @endauth
    </div>
</header>
<script src="{{ asset('js/Customer/navbar.js') }}"></script>
