@extends('layouts.app')
@section('judul', 'Dashboard')
@section('konten')
    <div class="card shadow-sm">
        <div class="card-body py-5">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h2 class="fw-bold px-3">
                        Selamat datang di sistem pengambil keputusan pemilihan majelis gereja
                    </h2>
                </div>

                <div class="col-12 col-md-6 col-sm-3">
                    <div class="row g-3 justify-content-center">
                        <div class="col-5">
                            <a href="{{ route('admin.majelis.create') }}" class="text-decoration-none">
                                <div class="bg-light d-flex align-items-center justify-content-center text-center p-4 border rounded shadow-sm hover-effect"
                                    style="aspect-ratio: 1/1;">
                                    <span class="fw-bold text-dark"> <i
                                            class="bi bi-person-plus-fill fs-1 mb-2 text-primary"></i>TAMBAH JEMAAT</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="{{ route('admin.user.index') }}" class="text-decoration-none">
                                <div class="bg-light d-flex align-items-center justify-content-center text-center p-4 border rounded shadow-sm hover-effect"
                                    style="aspect-ratio: 1/1;">
                                    <i class="bi bi-person-gear fs-1 mb-2 text-success"></i>
                                    <span class="fw-bold text-dark">KELOLA AKUN</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="text-decoration-none">
                                <div class="bg-light d-flex align-items-center justify-content-center text-center p-4 border rounded shadow-sm hover-effect"
                                    style="aspect-ratio: 1/1;">
                                    <span class="fw-bold text-dark"> <i
                                            class="bi bi-file-earmark-bar-graph fs-1 mb-2 text-danger"></i>LAPORAN</span>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col-5">
                                      <div class="bg-white d-flex align-items-center justify-content-center border rounded shadow-sm"
                                         style="aspect-ratio: 1/1; position: relative; overflow: hidden;">
                                         <svg width="100%" height="100%" style="position: absolute;">
                                            <line x1="0" y1="0" x2="100%" y2="100%" stroke="#dee2e6" stroke-width="2" />
                                            <line x1="100%" y1="0" x2="0" y2="100%" stroke="#dee2e6" stroke-width="2" />
                                         </svg>
                                      </div>
                                   </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Memberikan efek sedikit gelap saat kotak di-hover */
        .hover-effect:hover {
            background-color: #e9ecef !important;
            transition: 0.3s;
        }
    </style>
@endsection
