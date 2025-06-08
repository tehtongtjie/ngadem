<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
    style="background: linear-gradient(180deg, #2F2F2F 10%, #FF6F00 90%);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="max-height: 40px; width: auto;" />
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" style="border-color: #A9A9A9;"> <!-- abu terang -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}"
            style="{{ request()->routeIs('admin.dashboard') ? 'background-color: #FF6F00; color: #fff;' : 'color: #D1D1D1;' }}"
            onmouseover="this.style.backgroundColor='#FF8F00'; this.style.color='#000';"
            onmouseout="this.style.backgroundColor='{{ request()->routeIs('admin.dashboard') ? '#FF6F00' : 'transparent' }}'; this.style.color='{{ request()->routeIs('admin.dashboard') ? '#fff' : '#D1D1D1' }}';">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" style="border-color: #A9A9A9;">

    <!-- Heading -->
    <div class="sidebar-heading" style="color: #BDBDBD; font-weight: 600;">
        Manajemen Data
    </div>

    <!-- Nav Items -->
    <li class="nav-item {{ request()->routeIs('admin.customer.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.customer.index') }}"
            style="{{ request()->routeIs('admin.customer.*') ? 'background-color: #FF6F00; color: #fff;' : 'color: #D1D1D1;' }}"
            onmouseover="this.style.backgroundColor='#FF8F00'; this.style.color='#000';"
            onmouseout="this.style.backgroundColor='{{ request()->routeIs('admin.customer.*') ? '#FF6F00' : 'transparent' }}'; this.style.color='{{ request()->routeIs('admin.customer.*') ? '#fff' : '#D1D1D1' }}';">
            <i class="fas fa-fw fa-user"></i>
            <span>Manajemen Customer</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.teknisi.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.teknisi.index') }}"
            style="{{ request()->routeIs('admin.teknisi.*') ? 'background-color: #FF6F00; color: #fff;' : 'color: #D1D1D1;' }}"
            onmouseover="this.style.backgroundColor='#FF8F00'; this.style.color='#000';"
            onmouseout="this.style.backgroundColor='{{ request()->routeIs('admin.teknisi.*') ? '#FF6F00' : 'transparent' }}'; this.style.color='{{ request()->routeIs('admin.teknisi.*') ? '#fff' : '#D1D1D1' }}';">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Manajemen Teknisi</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.layanan.index') }}"
            style="{{ request()->routeIs('admin.layanan.*') ? 'background-color: #FF6F00; color: #fff;' : 'color: #D1D1D1;' }}"
            onmouseover="this.style.backgroundColor='#FF8F00'; this.style.color='#000';"
            onmouseout="this.style.backgroundColor='{{ request()->routeIs('admin.layanan.*') ? '#FF6F00' : 'transparent' }}'; this.style.color='{{ request()->routeIs('admin.layanan.*') ? '#fff' : '#D1D1D1' }}';">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Manajemen Layanan</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pembayaran.index') }}"
            style="{{ request()->routeIs('admin.pembayaran.*') ? 'background-color: #FF6F00; color: #fff;' : 'color: #D1D1D1;' }}"
            onmouseover="this.style.backgroundColor='#FF8F00'; this.style.color='#000';"
            onmouseout="this.style.backgroundColor='{{ request()->routeIs('admin.pembayaran.*') ? '#FF6F00' : 'transparent' }}'; this.style.color='{{ request()->routeIs('admin.pembayaran.*') ? '#fff' : '#D1D1D1' }}';">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Manajemen Pembayaran</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pesanan.index') }}"
            style="{{ request()->routeIs('admin.pesanan.*') ? 'background-color: #FF6F00; color: #fff;' : 'color: #D1D1D1;' }}"
            onmouseover="this.style.backgroundColor='#FF8F00'; this.style.color='#000';"
            onmouseout="this.style.backgroundColor='{{ request()->routeIs('admin.pesanan.*') ? '#FF6F00' : 'transparent' }}'; this.style.color='{{ request()->routeIs('admin.pesanan.*') ? '#fff' : '#D1D1D1' }}';">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Manajemen Pesanan</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.ulasan.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.ulasan.index') }}"
            style="{{ request()->routeIs('admin.ulasan.*') ? 'background-color: #FF6F00; color: #fff;' : 'color: #D1D1D1;' }}"
            onmouseover="this.style.backgroundColor='#FF8F00'; this.style.color='#000';"
            onmouseout="this.style.backgroundColor='{{ request()->routeIs('admin.ulasan.*') ? '#FF6F00' : 'transparent' }}'; this.style.color='{{ request()->routeIs('admin.ulasan.*') ? '#fff' : '#D1D1D1' }}';">
            <i class="fas fa-fw fa-comments"></i>
            <span>Manajemen Ulasan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="border-color: #A9A9A9;">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: #FF6F00;"></button>
    </div>

</ul>
