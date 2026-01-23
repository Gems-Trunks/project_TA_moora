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
                        <form action="{{ route('admin.korelasi.rank.reset') }}" method="POST"
                            onsubmit="return confirm('Yakin ingin mereset seluruh data pengujian Spearman?')"
                            class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i> Reset Spearman
                            </button>
                        </form>
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
                                <th>
                                    Rank MOORA <br>
                                    <small class="text-muted">(Xi)</small>
                                </th>
                                <th>
                                    Rank Manual <br>
                                    <small class="text-muted">(Yi)</small>
                                </th>
                                <th>
                                    d <br>
                                    <small class="text-muted">(Xi − Yi)</small>
                                </th>
                                <th>
                                    d<sup>2</sup>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $i => $row)
                                <tr class="text-center">
                                    <td>{{ $i + 1 }}</td>
                                    <td class="text-start">{{ $row->majelis->nama_calon }}</td>
                                    <td>{{ $row->nilai_sistem }}</td>
                                    <td>{{ $row->nilai_manual }}</td>
                                    <td>{{ $row->d }}</td>
                                    <td>{{ $row->d_kuadrat }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Data Uji Spearman belum tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @php
                    $absRho = abs($rho);
                @endphp
                <p><b>ρ (rho)</b> = {{ number_format($absRho, 4) }}</p>

                <p>
                    <b>Interpretasi:</b>
                    @if ($absRho >= 0.8)
                        Korelasi sangat kuat
                    @elseif ($absRho >= 0.6)
                        Korelasi kuat
                    @elseif ($absRho >= 0.4)
                        Korelasi sedang
                    @elseif ($absRho >= 0.2)
                        Korelasi lemah
                    @else
                        Korelasi sangat lemah
                    @endif

                    @if ($rho < 0)
                        (berlawanan arah)
                    @else
                        (searah)
                    @endif
                </p>
                <p><b>Kesimpulan:</b>
                    Metode MOORA memiliki tingkat kesesuaian
                    <b>{{ number_format($absRho * 100, 2) }}%</b>
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
