{{-- Sidebar Blade lengkap dengan styling collapse submenu --}}

<style>
    .sidebar .nav-link {
        color: #D1D1D1;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sidebar .nav-link:hover {
        background-color: #FF8F00 !important;
        color: #000 !important;
    }

    .sidebar .nav-item.active>.nav-link,
    .sidebar .nav-link.active {
        background-color: #FF6F00 !important;
        color: #fff !important;
    }

    .collapse-inner {
        background-color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
    }

    .collapse-header {
        font-weight: 600;
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 0.75rem;
    }

    .collapse-item {
        display: block;
        padding: 0.4rem 0;
        color: #6c757d;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.3s ease, background-color 0.3s ease;
        border-radius: 0.25rem;
    }

    .collapse-item:hover,
    .collapse-item.active {
        color: #fff !important;
        background-color: #FF6F00;
        text-decoration: none;
    }

    .sidebar-heading {
        color: #BDBDBD;
        font-weight: 600;
        font-size: 0.9rem;
        padding-left: 1rem;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }
</style>

<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
    style="background: linear-gradient(180deg, #2F2F2F 10%, #FF6F00 90%);">

    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('teknisi.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="max-height: 40px; width: auto;" />
        </div>
    </a>

    <hr class="sidebar-divider my-0" style="border-color: #A9A9A9;">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('teknisi.dashboard') ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs('teknisi.dashboard') ? 'active' : '' }}"
            href="{{ route('teknisi.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider" style="border-color: #A9A9A9;">

    <div class="sidebar-heading">Manajemen Data</div>

    <!-- Manajemen Pesanan with Collapse -->
    <li class="nav-item">
        <a class="nav-link collapsed {{ request()->routeIs('teknisi.orders.*') ? '' : 'collapsed' }}" href="#"
            data-toggle="collapse" data-target="#collapsePesanan"
            aria-expanded="{{ request()->routeIs('teknisi.orders.*') ? 'true' : 'false' }}"
            aria-controls="collapsePesanan">
            <i class="fas fa-fw fa-user"></i>
            <span>Manajemen Pesanan</span>
        </a>
        <div id="collapsePesanan" class="collapse {{ request()->routeIs('teknisi.orders.*') ? 'show' : '' }}"
            aria-labelledby="headingPesanan" data-parent="#accordionSidebar">
            <div class="collapse-inner rounded">
                <h6 class="collapse-header">Pesanan:</h6>
                <a class="collapse-item {{ request()->routeIs('teknisi.orders.index') ? 'active' : '' }}"
                    href="{{ route('teknisi.orders.index') }}">
                    Semua Pesanan
                </a>
                <a class="collapse-item {{ request()->routeIs('teknisi.orders.assigned') ? 'active' : '' }}"
                    href="{{ route('teknisi.orders.assigned') }}">
                    Pesanan Ditugaskan
                </a>
                <a class="collapse-item {{ request()->routeIs('teknisi.orders.pending') ? 'active' : '' }}"
                    href="{{ route('teknisi.orders.pending') }}">
                    Pesanan Pending
                </a>
                <a class="collapse-item {{ request()->routeIs('teknisi.orders.completed') ? 'active' : '' }}"
                    href="{{ route('teknisi.orders.completed') }}">
                    Pesanan Selesai
                </a>
                <a class="collapse-item {{ request()->routeIs('teknisi.orders.declined') ? 'active' : '' }}"
                    href="{{ route('teknisi.orders.declined') }}">
                    Pesanan Ditolak
                </a>
            </div>
        </div>
    </li>

    <!-- Total Pendapatan -->
    <li class="nav-item {{ request()->routeIs('teknisi.pendapatan.*') ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs('teknisi.pendapatan.*') ? 'active' : '' }}"
            href="{{ route('teknisi.pendapatan.index') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Total Pendapatan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block" style="border-color: #A9A9A9;">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: #FF6F00;"></button>
    </div>
</ul>
