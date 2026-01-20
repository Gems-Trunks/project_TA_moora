@extends('layouts.app')

@section('judul', 'Daftar Calon Majelis')

@section('konten')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold">Data Calon Majelis</h5>
                    <div class="btn-group">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-danger me-2">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('admin.majelis.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus-square"></i> Tambah Data
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
                                <th>Nama Lengkap</th>
                                <th>L/P</th>
                                <th>Usia</th>
                                <th>Masa Jemaat</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $d)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $d->nama_calon }}</td>
                                    <td class="text-center">
                                        {{ $d->jenis_kelamin }}
                                    </td>
                                    <td class="text-center">{{ $d->usia }} Thn</td>
                                    <td class="text-center">{{ $d->lama_menjadi_jemaat }} Thn</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.majelis.edit', $d->id) }}"
                                                class="btn btn-sm btn-warning text-white" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.majelis.delete', $d->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Data belum tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
