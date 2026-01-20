<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/images/logos/LOGO_GKE.png') }}" alt="Logo GKE"
                class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">Aplikasi Pemilihan</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase"><small>Manajemen Data</small></li>

                <li
                    class="nav-item {{ Route::is('admin.majelis.*') || Route::is('admin.kriteria.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::is('admin.majelis.*') || Route::is('admin.kriteria.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-database-fill"></i>
                        <p>
                            Data Master
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.majelis.index') }}"
                                class="nav-link {{ Route::is('admin.majelis.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Data Majelis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.kriteria.index') }}"
                                class="nav-link {{ Route::is('admin.kriteria.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Kriteria dan Bobot</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-cpu-fill"></i>
                        <p>
                            Proses Analisis
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.moora.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Proses Moora</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Uji Korelasi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ Route::is('admin.laporan.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-bar-graph"></i>
                        <p>Laporan</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase"><small>Pengaturan Sistem</small></li>

                <li class="nav-item">
                    <a href="{{ route('admin.profil') }}" class="nav-link">
                        <i class="nav-icon bi bi-person-bounding-box"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('admin.user.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.user.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            Kelola Akun
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                                class="nav-link {{ Route::is('admin.user.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item mt-3">
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
