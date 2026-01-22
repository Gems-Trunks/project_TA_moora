@extends('layouts.app')

@section('judul', 'Uji Korelasi Spearman')

@section('konten')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold">Uji Korelasi Spearman</h5>
                    <div class="btn-group">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-danger me-2">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('admin.korelasi.rank.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus-square"></i> isi ranking Manual
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="50px">No</th>
                                <th>Nama Calon</th>
                                <th>Rank Moora</th>
                                <th>Rank Manual</th>
                                <th>d</th>
                                <th>d<sup>2</sup></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i => $row)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $row->majelis->nama_calon }}</td>
                                    <td>{{ $row->nilai_sistem }}</td>
                                    <td>{{ $row->nilai_manual }}</td>
                                    <td>{{ $row->d }}</td>
                                    <td>{{ $row->d_kuadrat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p><b>ρ (rho)</b> = {{ number_format($rho, 4) }}</p>

                <p>
                    <b>Interpretasi:</b>
                    @if ($rho >= 0.8)
                        Korelasi sangat kuat
                    @elseif ($rho >= 0.6)
                        Korelasi kuat
                    @elseif ($rho >= 0.4)
                        Korelasi sedang
                    @elseif ($rho >= 0.2)
                        Korelasi lemah
                    @else
                        Korelasi sangat lemah
                    @endif
                </p>

                <p><b>Kesimpulan:</b>
                    Metode MOORA memiliki tingkat kesesuaian
                    <b>{{ number_format($rho * 100, 2) }}%</b>
                    dengan penilaian manual.
                </p>
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
