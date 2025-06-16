<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" type="button">
        <i class="fa fa-bars" style="color:#FF6600;"></i>
    </button>

    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block" style="border-color:#FFA500;"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#FF6600;">
                <span
                    class="mr-2 d-none d-lg-inline text-warning small font-weight-bold">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle border border-warning"
                    src="{{ asset('template/img/undraw_profile.svg') }}" alt="User Profile Picture" />
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    style="color:#FF6600;">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-warning"></i>
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>
