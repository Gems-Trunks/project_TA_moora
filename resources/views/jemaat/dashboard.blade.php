@extends('layouts.app')

@section('judul', 'Dashboard')

@section('konten')
    <div class="card shadow-sm border-0">
        <div class="card-body py-5">
            <div class="row align-items-center">

                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="fw-bold px-lg-4 display-6" style="line-height: 1.4;">
                        Selamat datang di sistem pengambil keputusan pemilihan majelis gereja
                    </h1>
                </div>

                <div class="col-lg-6">
                    <div class="row g-3 flex">

                        <div class="col-5">
                            <a href="{{ route('jemaat.penilaian') }}" class="text-decoration-none">
                                <div class="menu-box bg-light border rounded shadow-sm hover-effect">
                                    <i class="fa fa-star fa-3x"></i>
                                    <span class="fw-bold text-dark mt-2">Penilaian</span>
                                </div>
                            </a>
                        </div>

                        <div class="col-5">
                            <a href="{{ route('jemaat.perengkingan') }}" class="text-decoration-none">
                                <div class="menu-box bg-light border rounded shadow-sm hover-effect">
                                    <i class="bi bi bi-bar-chart-line-fill fs-1 text-success"></i>
                                    <span class="fw-bold text-dark mt-2">Perengkingan</span>
                                </div>
                            </a>
                        </div>

                        <div class="col-5">
                            <a href="{{ route('jemaat.profil') }}" class="text-decoration-none">
                                <div class="menu-box bg-light border rounded shadow-sm hover-effect">
                                    <i class="bi bi-person-fill fs-1 text-danger"></i>
                                    <span class="fw-bold text-dark mt-2">Profil</span>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Style untuk membuat kotak proporsional dan rapi */
        .menu-box {
            aspect-ratio: 1/1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            transition: all 0.3s ease;
        }

        /* Efek Hover */
        .hover-effect:hover {
            background-color: #f8f9fa !important;
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        /* Responsivitas teks agar tidak terlalu besar di HP */
        @media (max-width: 768px) {
            .menu-box span {
                font-size: 0.8rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
