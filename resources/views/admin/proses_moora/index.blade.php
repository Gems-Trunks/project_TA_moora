@extends('layouts.app')

@section('judul', 'Hasil Perankingkan')

@section('konten')
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold m-0">Hasil Perankingkan</h4>
                    <a href="{{ route('admin.moora.show') }}" class="btn btn-light border shadow-sm px-4">
                        Perhitungan Moora
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th width="70px">No</th>
                                <th>NAMA</th>
                                <th>Nilai Akhir</th>
                                <th>RANK</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rankings as $rank)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $rank->nama_calon }}</td>
                                    <td class="text-center">{{ number_format($rank->nilai_moora, 4) }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $loop->iteration <= 3 ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $loop->iteration }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{ $loop->iteration <= 5 ? 'Direkomendasikan' : 'Cadangan' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        Silahkan klik tombol "Perhitungan Moora" untuk melihat hasil.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Styling agar tabel terlihat kotak-kotak tegas sesuai gambar */
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #333 !important;
            /* Garis lebih gelap sesuai gambar */
        }

        .table thead th {
            vertical-align: middle;
        }
    </style>
@endsection
