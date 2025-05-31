<ul id="accordionSidebar"
    class="flex flex-col h-screen overflow-y-auto overflow-x-hidden
           bg-gray-900 {{-- Warna solid abu-abu gelap untuk sidebar --}}
           md:w-64 w-64 {{-- Selalu lebar penuh, bahkan di mobile (jika md: tidak aktif) --}}
           ">

    <a class="flex items-center justify-center h-20 text-white text-xl font-bold py-4"
        href="{{ route('admin.dashboard') }}">
        {{-- Container logo dengan lebar permanen, tidak perlu toggle --}}
        <div class="flex items-center justify-center h-12 w-36 overflow-hidden">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="max-w-full h-auto max-h-12 object-contain">
        </div>
        {{-- Jika Anda ingin teks brand di sini, hilangkan kelas 'hidden' jika sebelumnya ada --}}
        {{-- <span class="text-white text-2xl font-bold ml-2">NGADEM</span> --}}
    </a>

    <hr class="border-t border-gray-700 my-0 mx-4">

    <li class="relative">
        <a class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-800 hover:text-white rounded-md mx-3 mt-2
                  {{ request()->routeIs('admin.dashboard') ? 'bg-orange-600 text-white font-semibold shadow-md' : '' }}
                  transition-colors duration-200 ease-in-out"
            href="{{ route('admin.dashboard') }}">
            {{-- Ukuran ikon tetap besar --}}
            <i
                class="fas fa-fw fa-tachometer-alt text-gray-500 mr-4 text-xl {{ request()->routeIs('admin.dashboard') ? 'text-white' : '' }}"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="border-t border-gray-700 my-4 mx-4">

    <div class="px-6 py-2 text-sm text-gray-500 uppercase tracking-wider font-semibold">
        Manajemen Data
    </div>

    <li class="relative">
        <a class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-800 hover:text-white rounded-md mx-3
                  {{ request()->routeIs('admin.customer.*') ? 'bg-orange-600 text-white font-semibold shadow-md' : '' }}
                  transition-colors duration-200 ease-in-out"
            href="{{ route('admin.customer.index') }}">
            <i
                class="fas fa-fw fa-user text-gray-500 mr-4 text-xl {{ request()->routeIs('admin.customer.*') ? 'text-white' : '' }}"></i>
            <span>Manajemen Customer</span>
        </a>
    </li>

    <li class="relative">
        <a class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-800 hover:text-white rounded-md mx-3
                  {{ request()->routeIs('admin.teknisi.*') ? 'bg-orange-600 text-white font-semibold shadow-md' : '' }}
                  transition-colors duration-200 ease-in-out"
            href="{{ route('admin.teknisi.index') }}">
            <i
                class="fas fa-fw fa-user-tie text-gray-500 mr-4 text-xl {{ request()->routeIs('admin.teknisi.*') ? 'text-white' : '' }}"></i>
            <span>Manajemen Teknisi</span>
        </a>
    </li>

    <li class="relative">
        <a class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-800 hover:text-white rounded-md mx-3
                  {{ request()->routeIs('admin.pesanan.*') ? 'bg-orange-600 text-white font-semibold shadow-md' : '' }}
                  transition-colors duration-200 ease-in-out"
            href="{{ route('admin.pesanan.index') }}">
            <i
                class="fas fa-fw fa-receipt text-gray-500 mr-4 text-xl {{ request()->routeIs('admin.pesanan.*') ? 'text-white' : '' }}"></i>
            <span>Manajemen Pesanan</span>
        </a>
    </li>

    <li class="relative">
        <a class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-800 hover:text-white rounded-md mx-3
                  {{ request()->routeIs('admin.pembayaran.*') ? 'bg-orange-600 text-white font-semibold shadow-md' : '' }}
                  transition-colors duration-200 ease-in-out"
            href="{{ route('admin.pembayaran.index') }}">
            <i
                class="fas fa-fw fa-cash-register text-gray-500 mr-4 text-xl {{ request()->routeIs('admin.pembayaran.*') ? 'text-white' : '' }}"></i>
            <span>Manajemen Pembayaran</span>
        </a>
    </li>

    <li class="relative">
        <a class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-800 hover:text-white rounded-md mx-3
                  {{ request()->routeIs('admin.layanan.*') ? 'bg-orange-600 text-white font-semibold shadow-md' : '' }}
                  transition-colors duration-200 ease-in-out"
            href="{{ route('admin.layanan.index') }}">
            <i
                class="fas fa-fw fa-hand-holding-heart text-gray-500 mr-4 text-xl {{ request()->routeIs('admin.layanan.*') ? 'text-white' : '' }}"></i>
            <span>Manajemen Layanan</span>
        </a>
    </li>

    <li class="relative">
        <a class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-800 hover:text-white rounded-md mx-3
                  {{ request()->routeIs('admin.ulasan.*') ? 'bg-orange-600 text-white font-semibold shadow-md' : '' }}
                  transition-colors duration-200 ease-in-out"
            href="{{ route('admin.ulasan.index') }}">
            <i
                class="fas fa-fw fa-comments text-gray-500 mr-4 text-xl {{ request()->routeIs('admin.ulasan.*') ? 'text-white' : '' }}"></i>
            <span>Manajemen Ulasan</span>
        </a>
    </li>

    <hr class="border-t border-gray-700 my-4 mx-4">

    {{-- Tombol Sidebar Toggler dihapus sepenuhnya --}}

</ul>

{{-- Hapus seluruh blok <script> yang sebelumnya ada di sini, karena tidak lagi diperlukan --}}
