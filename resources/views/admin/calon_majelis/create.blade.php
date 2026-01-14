@extends('layouts.app')

@section('judul', 'Tambah Calon Majelis')

@section('konten')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-4">
                        <h5 class="mb-4 fw-bold">Form Tambah Calon Majelis</h5>

                        <form action="{{ route('admin.majelis.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Calon :</label>
                                        <input type="text" name="nama_calon" id="nama"
                                            class="form-control bg-light @error('nama_calon') is-invalid @enderror"
                                            value="{{ old('nama_calon') }}" required>
                                        @error('nama_calon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="jk" class="form-label">Jenis kelamin :</label>
                                        <select name="jenis_kelamin" id="jk" class="form-select bg-light" required>
                                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="usia" class="form-label">Usia :</label>
                                        <input type="number" name="usia" id="usia" class="form-control bg-light"
                                            value="{{ old('usia') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="lama_jemaat" class="form-label">Lama Menjadi Jemaat :</label>
                                        <input type="number" name="lama_menjadi_jemaat" id="lama_jemaat"
                                            class="form-control bg-light" value="{{ old('lama_menjadi_jemaat') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="{{ route('admin.majelis.index') }}"
                                            class="btn btn-outline-secondary px-4 me-2">Batal</a>
                                        <button type="submit" class="btn btn-light border px-4 shadow-sm">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Tambahan agar input terlihat seperti di gambar (minimalis) */
        .form-control,
        .form-select {
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }
    </style>
@endsection
