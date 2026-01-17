<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aplikasi Pemilihan | Masuk</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="Aplikasi Pemilihan | Masuk" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    {{-- <link rel="preload" href="../css/adminlte.css" as="style" /> --}}
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    {{-- <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}" /> --}}
    <!--end::Required Plugin(AdminLTE)-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('assets/images/logos/LOGO_GKE.png') }}" type="image/x-icon">

</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary">
    <div class="login-box" style="width: 400px;">
        <div class="login-logo mb-4">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('assets/images/logos/LOGO_GKE.png') }}" alt="logo gke"
                    style="width: 70px; height: auto;" class="mb-3">
                <a href="#" class="text-decoration-none fw-bold"
                    style="font-size: 1rem; line-height: 1.2; color: #333;">
                    APLIKASI PEMILIHAN MAJELIS JEMAAT GKE<br>
                    <span class="text-primary" style="font-size: 1.2rem;">HOSANA DESA BANTAI BAMBURE</span>
                </a>
            </div>
        </div>
        <div class="card card-outline card-primary shadow-lg">
            <div class="card-body login-card-body">
                <p class="login-box-msg fw-bold">Silakan masuk ke akun Anda</p>

                <form action="{{ route('login_proses') }}" method="post">
                    @csrf <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required />
                        <div class="input-group-text">
                            <span class="bi bi-person"></span>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required />
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary fw-bold">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> MASUK
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-1 small">
                        <a href="forgot-password.html" class="text-decoration-none text-muted">Lupa password?</a>
                    </p>
                    <p class="mb-0 small">
                        Belum punya akun? <a href="register.html" class="text-center fw-bold">Daftar Jemaat</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- /.login-box -->
        <!--begin::Third Party Plugin(OverlayScrollbars)-->
        <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
            crossorigin="anonymous"></script>
        <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
        </script>
        <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
        <script src="{{ asset('assets/js/adminlte.js') }}"></script>
        <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
        <script>
            const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
            const Default = {
                scrollbarTheme: 'os-theme-light',
                scrollbarAutoHide: 'leave',
                scrollbarClickScroll: true,
            };
            document.addEventListener('DOMContentLoaded', function() {
                const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
                if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                    OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                        scrollbars: {
                            theme: Default.scrollbarTheme,
                            autoHide: Default.scrollbarAutoHide,
                            clickScroll: Default.scrollbarClickScroll,
                        },
                    });
                }
            });
        </script>
        <!--end::OverlayScrollbars Configure-->
        <!--end::Script-->
</body>
<!--end::Body-->

</html>
