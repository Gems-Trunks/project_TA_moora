@extends('layouts.app')

@section('judul', 'Edit Kriteria SPK')

@section('konten')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-4">
                        <h5 class="mb-4 fw-bold text-warning">Edit Data Kriteria</h5>

                        <form action="{{ route('admin.kriteria.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_kriteria" class="form-label">Nama Kriteria :</label>
                                <input type="text" name="nama_kriteria" id="nama_kriteria"
                                    class="form-control bg-light @error('nama_kriteria') is-invalid @enderror"
                                    value="{{ old('nama_kriteria', $data->nama_kriteria) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="bobot" class="form-label">Bobot Kriteria :</label>
                                <input type="number" step="0.01" name="bobot" id="bobot"
                                    class="form-control bg-light" value="{{ old('bobot', $data->bobot) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="jenis" class="form-label">Jenis Kriteria :</label>
                                <select name="jenis" id="jenis" class="form-select bg-light" required>
                                    <option value="Benefit" {{ old('jenis', $data->jenis) == 'Benefit' ? 'selected' : '' }}>
                                        Benefit</option>
                                    <option value="Cost" {{ old('jenis', $data->jenis) == 'Cost' ? 'selected' : '' }}>Cost
                                    </option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.kriteria.index') }}"
                                    class="btn btn-outline-secondary px-4">Batal</a>
                                <button type="submit" class="btn btn-warning text-white px-4 shadow-sm">Update
                                    Kriteria</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
