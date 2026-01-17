@extends('layouts.app')

@section('judul', 'Daftar Kriteria MOORA')

@section('konten')
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold text-dark">Data Kriteria MOORA</h5>
                    <div class="btn-group">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-danger me-2">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('admin.kriteria.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus-square"></i> Tambah Kriteria
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
                                <th>Nama Kriteria</th>
                                <th>Bobot (W)</th>
                                <th>Jenis</th>
                                <th width="120px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $d)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>{{ $d->nama_kriteria }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary px-3">{{ $d->bobot }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if ($d->jenis == 'benefit')
                                            <span class="text-success fw-bold"><i class="fa fa-arrow-up small"></i>
                                                Benefit</span>
                                        @else
                                            <span class="text-danger fw-bold"><i class="fa fa-arrow-down small"></i>
                                                Cost</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.kriteria.edit', $d->id) }}"
                                                class="btn btn-sm btn-warning text-white" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.kriteria.delete', $d->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus kriteria {{ $d->nama_kriteria }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="fa fa-folder-open fa-3x mb-3 d-block"></i>
                                        Belum ada data kriteria.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 p-3 bg-light rounded">
                    <small class="text-muted">
                        <strong>Info:</strong> Dalam metode MOORA, total bobot (W) idealnya berjumlah <strong>1</strong>
                        atau <strong>100%</strong>.
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
