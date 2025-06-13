<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" type="button">
        <i class="fa fa-bars" style="color:#FF6600;"></i> <!-- ikon warna orange -->
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" style="color:#FF6600;">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Search -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                            <button class="btn" type="button" style="background-color:#FFA500; color:white;">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" style="color:#FF6600;">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-warning badge-counter" style="background-color:#FFA500; color:#fff;">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header" style="color:#FF6600;">
                    Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle" style="background-color:#FF6600;">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-muted" style="color: #B36B00;">December 12, 2019</div>
                        <span class="font-weight-bold" style="color:#FF6600;">A new monthly report is ready to
                            download!</span>
                    </div>
                </a>
                <!-- Tambah alert lainnya sesuai kebutuhan -->
                <a class="dropdown-item text-center small" href="#" style="color:#FF6600;">Show All Alerts</a>
            </div>

            <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#FF6600;">
                <i class="fas fa-envelope fa-fw" style="color:#FF6600;"></i>
                <!-- Counter - Messages -->
                <span class="badge" style="background-color:#FFA500; color:#fff; font-weight:bold;">7</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header" style="color:#FF6600;">
                    Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="{{ asset('template/img/undraw_profile_1.svg') }}"
                            alt="Profile 1" />
                        <div class="status-indicator" style="background-color:#FFA500;"></div> <!-- Ganti bg-success -->
                    </div>
                    <div class="font-weight-bold" style="color:#FF6600;">
                        <div class="text-truncate" style="color:#B36B00;">
                            Hi there! I am wondering if you can help me with a problem I've been having.
                        </div>
                        <div class="small" style="color:#B36B00;">Emily Fowler · 58m</div>
                    </div>
                </a>
                <!-- Tambah pesan lainnya sesuai kebutuhan -->
                <a class="dropdown-item text-center small" href="#" style="color:#FF6600;">Read More
                    Messages</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block" style="border-color:#FFA500;"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#FF6600;">
                <span
                    class="mr-2 d-none d-lg-inline text-warning small font-weight-bold">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle border border-warning"
                    src="{{ asset('template/img/undraw_profile.svg') }}" alt="User Profile Picture" />
            </a>
            <!-- Dropdown - User Information -->
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
