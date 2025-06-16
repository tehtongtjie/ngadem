<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars text-primary-custom"></i> {{-- Menggunakan kelas kustom untuk warna --}}
    </button>

    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block custom-divider-color"></div> {{-- Menggunakan kelas kustom untuk warna --}}

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small font-weight-bold">{{ Auth::user()->name }}</span> {{-- Warna teks default SB Admin --}}
                <img class="img-profile rounded-circle border border-warning"
                    src="{{ asset('template/img/undraw_profile.svg') }}" alt="User Profile Picture" />
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item text-primary-custom" href="{{ route('teknisi.profile.index') }}"> {{-- Menggunakan kelas kustom untuk warna --}}
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary-custom"></i> {{-- Icon juga kustom --}}
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                
                {{-- Logout button harus ada di dalam dropdown-menu, bukan di luarnya --}}
                <a class="dropdown-item text-primary-custom" href="#" data-toggle="modal" data-target="#logoutModal"> {{-- Menggunakan modal untuk logout --}}
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-primary-custom"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>

{{-- Pastikan Anda memiliki modal logout di file layout utama (misalnya layouts/Admin/app.blade.php) --}}
{{-- Contoh struktur modal: --}}
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Siap untuk Keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-modal').submit();">Logout</a>
                <form id="logout-form-modal" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for the topbar */
    .text-primary-custom {
        color: #FF6600 !important; /* Warna oranye terang */
    }

    .custom-divider-color {
        border-color: #FFA500 !important; /* Warna oranye untuk divider */
    }

    /* User dropdown */
    .img-profile {
        width: 2.25rem; /* Ukuran default dari SB Admin */
        height: 2.25rem;
    }

    .border-warning { /* Override border dari SB Admin jika perlu */
        border-color: #FFA500 !important;
    }
</style>