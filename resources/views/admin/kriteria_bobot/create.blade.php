@extends('layouts.app')

@section('judul', 'Tambah Kriteria SPK')

@section('konten')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-4">
                        <h5 class="mb-4 fw-bold">Form Tambah Kriteria</h5>

                        <form action="{{ route('admin.kriteria.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_kriteria" class="form-label">Nama Kriteria :</label>
                                <input type="text" name="nama_kriteria" id="nama_kriteria"
                                    class="form-control bg-light @error('nama_kriteria') is-invalid @enderror"
                                    value="{{ old('nama_kriteria') }}" placeholder="Contoh: Pengalaman Organisasi" required>
                                @error('nama_kriteria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bobot" class="form-label">Bobot Kriteria (%) :</label>
                                <input type="number" step="0.01" name="bobot" id="bobot"
                                    class="form-control bg-light" value="{{ old('bobot') }}"
                                    placeholder="Contoh: 0.25 atau 25" required>
                                <small class="text-muted text-italic">*Gunakan titik untuk desimal</small>
                            </div>

                            <div class="mb-4">
                                <label for="jenis" class="form-label">Jenis Kriteria :</label>
                                <select name="jenis" id="jenis" class="form-select bg-light" required>
                                    <option value="" selected disabled>-- Pilih Jenis --</option>
                                    <option value="Benefit" {{ old('jenis') == 'Benefit' ? 'selected' : '' }}>Benefit
                                        (Semakin besar semakin baik)</option>
                                    <option value="Cost" {{ old('jenis') == 'Cost' ? 'selected' : '' }}>Cost (Semakin
                                        kecil semakin baik)</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.kriteria.index') }}"
                                    class="btn btn-outline-secondary px-4">Batal</a>
                                <button type="submit" class="btn btn-success px-4 shadow-sm">Simpan Kriteria</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
