@extends('layouts.app')

@section('judul', 'Proes Moora')

@section('konten')

    {{-- Informasi status proses --}}
    @if (!$adaHasil)
        <div class="alert alert-info">
            <strong>Informasi:</strong>
            Data belum diproses. Silakan klik tombol <b>Proses MOORA</b> untuk melihat hasil perhitungan.
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="m-0 font-weight-bold text-primary">Proses Analisis MOORA</h6>

                <form action="{{ route('admin.moora.proses') }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin memproses ulang data MOORA?')">
                    @csrf
                    <button class="btn btn-primary">
                        <i class="fa fa-calculator"></i> Proses MOORA
                    </button>
                </form>
            </div>

            <p class="text-muted mb-0">
                Proses perangkingan dilakukan menggunakan metode <b>MOORA</b> dengan tahapan
                matriks keputusan, normalisasi, dan optimasi nilai Yi.
            </p>
        </div>

        <div class="card-body">

            {{-- TAB --}}
            <ul class="nav nav-tabs" id="mooraTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#matriks">
                        1. Matriks Keputusan (X)
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link {{ !$adaHasil ? 'disabled' : '' }}" data-bs-toggle="tab"
                        data-bs-target="#normalisasi">
                        2. Normalisasi & Bobot
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link {{ !$adaHasil ? 'disabled' : '' }}" data-bs-toggle="tab"
                        data-bs-target="#ranking">
                        3. Hasil Perangkingan (Yi)
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-3">

                {{-- TAB 1 : MATRKS KEPUTUSAN --}}
                <div class="tab-pane fade show active" id="matriks">
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark text-center align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th rowspan="2">Nama Calon Majelis</th>
                                    <th colspan="{{ $kriteria->count() }}">Kriteria</th>
                                </tr>
                                <tr>
                                    @foreach ($kriteria as $k)
                                        <th>{{ $k->nama_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($penilaian as $id_calon => $items)
                                    <tr>
                                        <td class="text-start ps-3">
                                            {{ $items->first()->majelis->nama_calon }}
                                        </td>

                                        @foreach ($kriteria as $k)
                                            @php
                                                $row = $items->where('id_kriteria', $k->id)->first();
                                            @endphp
                                            <td>
                                                {{ $row ? number_format($row->nilai, 2) : '0.00' }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $kriteria->count() + 1 }}" class="text-center text-muted py-4">
                                            Data penilaian belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                            <tfoot class="fw-bold bg-light">
                                <tr>
                                    <td>Bobot (W)</td>
                                    @forelse ($kriteria as $k)
                                        <td>{{ $k->bobot }}</td>
                                    @empty
                                        <td class="text-center text-muted">-</td>
                                    @endforelse
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- TAB 2 : NORMALISASI --}}
                <div class="tab-pane fade" id="normalisasi">
                    @if ($adaHasil)
                        <table class="table table-responsive table-bordered border-dark align-middle">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th>Nama Calon</th>
                                    <th>Kriteria</th>
                                    <th>Nilai Awal</th>
                                    <th>Normalisasi</th>
                                    <th>Terbobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($penilaian as $id_calon => $items)
                                    @foreach ($kriteria as $index => $k)
                                        @php
                                            $proses = $dataProses
                                                ->where('id_calon', $id_calon)
                                                ->where('id_kriteria', $k->id)
                                                ->first();
                                        @endphp

                                        <tr>
                                            @if ($index == 0)
                                                <td rowspan="{{ $kriteria->count() }}" class="fw-bold text-center">
                                                    {{ $items->first()->majelis->nama_calon }}
                                                </td>
                                            @endif

                                            <td>{{ $k->nama }}</td>
                                            <td class="text-center">
                                                {{ $proses ? number_format($proses->nilai_awal, 2) : '0.00' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $proses ? number_format($proses->nilai_normalisasi, 4) : '0.0000' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $proses ? number_format($proses->nilai_bobot, 4) : '0.0000' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            Data belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-secondary text-center">
                            Data normalisasi akan ditampilkan setelah proses MOORA dijalankan.
                        </div>
                    @endif
                </div>

                {{-- TAB 3 : RANKING --}}
                <div class="tab-pane fade" id="ranking">
                    @if ($adaHasil)
                        <table class="table table-responsive table-bordered border-dark align-middle">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th width="15%">Ranking</th>
                                    <th width="55%">Nama Calon</th>
                                    <th width="30%">Nilai Yi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasilRanking as $index => $r)
                                    @php $isFirst = $index === 0; @endphp
                                    <tr class="{{ $isFirst ? 'table-warning' : '' }}">
                                        <td class="text-center">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="{{ $isFirst ? 'fw-bold text-primary' : '' }}">
                                            {{ $r->majelis->nama_calon }}
                                            @if ($isFirst)
                                                <span class="badge bg-success ms-2">Rekomendasi Utama</span>
                                            @endif
                                        </td>
                                        <td class="text-center fw-bold">
                                            {{ number_format($r->nilai_yi, 4) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-secondary text-center">
                            Hasil perangkingan akan ditampilkan setelah proses MOORA dijalankan.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}'
            })
        </script>
    @endif
@endsection
