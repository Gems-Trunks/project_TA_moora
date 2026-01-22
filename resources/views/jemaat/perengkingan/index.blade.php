@extends('layouts.app')

@section('judul', 'Hasil Perengkingan')

@section('konten')
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold text-dark">Data Hasil Perengkigan</h5>
                    <div class="btn-group">
                        <a href="{{ route('jemaat.dashboard') }}" class="btn btn-sm btn-outline-danger me-2">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('jemaat.perengkingan.cetak') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus-square"></i> Cetak
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="60px">No</th>
                                <th>Nama Calon Majelis</th>
                                <th>Nilai Akhir</th>
                                <th>Ranking</th>
                                <th width="200px">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td class='text-center'>{{ $d->majelis->nama_calon }}</td>
                                    <td class="text-center">
                                        {{ $d->nilai_yi }}
                                    </td>
                                    <td class="text-center">
                                        {{ $d->peringkat }}
                                    </td>
                                    <td class="text-center ">
                                        @if ($d->keterangan == null)
                                            <p>keterangan belum di masukan panitia</p>
                                        @else
                                            {{ $d->keterangan }}
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 p-3 bg-light rounded">
                    <small class="text-muted">
                        <strong>Info:</strong> Hasil Pemilihan ini berupa hasil perhitungan dari metode SPK Moora
                    </small>
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
