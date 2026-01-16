@extends('layouts.app')

@section('judul', 'Edit Akun')

@section('konten')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-4">
                        <h5 class="mb-4 fw-bold">Form Edit Akun</h5>

                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    class="form-control bg-light @error('nama_lengkap') is-invalid @enderror"
                                    value="{{ old('nama_lengkap', $user->nama_lengkap) }}" placeholder="Nama Lengkap"
                                    required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

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
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control bg-light @error('password') is-invalid @enderror"
                                    placeholder="Isi jika ingin mengganti password">
                                <small class="text-muted mt-1 d-block">Kosongkan jika tidak ingin mengubah password.</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select bg-light" required>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="jemaat" {{ old('role', $user->role) == 'jemaat' ? 'selected' : '' }}>
                                        Jemaat</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">Perbarui Akun</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
