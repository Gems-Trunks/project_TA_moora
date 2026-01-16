@extends('layouts.app')

@section('judul', 'Akun User')

@section('konten')
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold text-dark">Akun User</h5>
                    <div class="btn-group">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-outline-danger me-2">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus-square"></i> Tambah Akun
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
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Tanggal Daftar</th>
                                <th width="120px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $d)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>{{ $d->nama_lengkap }}</td>
                                    <td>{{ $d->username }}</td>
                                    <td>{{ $d->password }}</td>
                                    <td>{{ $d->role }}</td>
                                    <td>{{ tanggal($d->created_at) }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.user.edit', $d->id) }}"
                                                class="btn btn-sm btn-warning text-white" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.user.delete', $d->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus Akun ini {{ $d->username }}?')">
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
            </div>
        </div>
    </div>
@endsection
