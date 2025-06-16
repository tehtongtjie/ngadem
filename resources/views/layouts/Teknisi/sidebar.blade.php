<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
    style="background: linear-gradient(180deg, #2F2F2F 10%, #FF6F00 90%);">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand-icon d-flex align-items-center justify-content-center mt-3">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 40px;" />
    </div>

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('teknisi.dashboard') ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs('teknisi.dashboard') ? 'active' : '' }}"
            href="{{ route('teknisi.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" style="border-color: #A9A9A9;">

    <!-- Heading -->
    <div class="sidebar-heading">Manajemen Data</div>

    <!-- Manajemen Pesanan -->
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

            <div class="collapse-inner bg-white rounded py-2 px-3 shadow-sm">
                <h6 class="collapse-header text-dark">Pesanan:</h6>
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


        <!-- Total Pendapatan -->
    <li class="nav-item {{ request()->routeIs('teknisi.pendapatan.*') ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs('teknisi.pendapatan.*') ? 'active' : '' }}"
            href="{{ route('teknisi.pendapatan.index') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Total Pendapatan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="border-color: #A9A9A9;">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: #FF6F00;"></button>
    </div>

</ul>
