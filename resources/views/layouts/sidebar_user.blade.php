<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('jemaat.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/images/logos/LOGO_GKE.png') }}" alt="Logo GKE"
                class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">Aplikasi Pemilihan</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('jemaat.dashboard') }}"
                        class="nav-link {{ Route::is('jemaat.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('jemaat.penilaian') }}"
                        class="nav-link {{ Route::is('jemaat.penilaian') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>Penilaian</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ Route::is('jemaat.perengkingan') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-bar-chart-line"></i>
                        <p>Perengkingan</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase"><small>Akun Saya</small></li>

                <li class="nav-item">
                    <a href="{{ route('jemaat.profil') }}"
                        class="nav-link {{ Route::is('jemaat.profil') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>Profil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">@csrf</form>
                    <a href="#" class="nav-link text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <p>Keluar</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
