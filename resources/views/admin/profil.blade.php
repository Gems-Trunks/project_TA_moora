@extends('layouts.app')

@section('judul', 'Edit Profil')

@section('konten')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-4">
                        <h5 class="mb-4 fw-bold">Edit Profil</h5>

                        <form action="{{ route('admin.profil.update') }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username"
                                    class="form-control bg-light @error('username') is-invalid @enderror"
                                    value="{{ old('username', $user->username) }}" placeholder="Username" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    class="form-control bg-light @error('nama_lengkap') is-invalid @enderror"
                                    value="{{ old('nama_lengkap', $user->nama_lengkap) }}" placeholder="nama_lengkap"
                                    required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru (Kosongkan jika tidak ganti)</label>
                                <input type="password" name="password" id="password"
                                    class="form-control bg-light @error('password') is-invalid @enderror"
                                    placeholder="Password Baru">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Ulangi Password Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control bg-light" placeholder="Ulangi Password Baru">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4">Batal</a>
                                <button type="submit" class="btn btn-success px-4 shadow-sm">Simpan Akun</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
