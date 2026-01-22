<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Aplikasi Pemilihan | Masuk</title>

    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('assets/images/logos/LOGO_GKE.png') }}">
</head>

<body class="login-page bg-body-secondary">

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-sm-10 col-md-6 col-lg-6">

                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">

                        <!-- LOGO -->
                        <div class="text-center mb-4 d-flex flex-column align-items-center">
                            <img src="{{ asset('assets/images/logos/LOGO_GKE.png') }}" alt="Logo GKE" class="mb-3"
                                style="width: 80px; height: auto; display: block; margin: 0 auto;">

                            <h6 class="fw-bold mb-1 text-center">
                                APLIKASI PEMILIHAN MAJELIS JEMAAT GKE
                            </h6>
                            <div class="text-primary fw-bold text-center">
                                HOSANA DESA BANTAI BAMBURE
                            </div>
                        </div>

                        <!-- TITLE -->
                        <p class="text-center fw-bold mb-3">
                            Silakan masuk ke akun Anda
                        </p>

                        <!-- FORM -->
                        <form action="{{ route('login_proses') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="Username" value="{{ old('username') }}" required>
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" required>
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary fw-bold">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> MASUK
                                </button>
                            </div>
                        </form>

                        <!-- FOOTER -->
                        <div class="text-center mt-4 small">
                            <p class="mb-1">
                                <a href="#" class="text-muted text-decoration-none">
                                    Lupa password?
                                </a>
                            </p>
                            <p class="mb-0">
                                Belum punya akun?
                                <a href="#" class="fw-bold text-decoration-none">
                                    Daftar Jemaat
                                </a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
