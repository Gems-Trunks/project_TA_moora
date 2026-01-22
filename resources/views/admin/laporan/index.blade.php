@extends('layouts.app')

@section('judul', 'Laporan Daftar Data Pemilihan Majelis Jemaat')

@section('konten')
    <div class="card shadow">
        <div class="card-body text-center">

            <form action="{{ route('admin.laporan.cetak') }}" method="POST">
                @csrf

                <div class="row justify-content-center mb-4">
                    <div class="col-md-5">
                        <select name="jenis_laporan" class="form-select" required>
                            <option value="">-- Pilih Daftar Laporan --</option>
                            <option value="calon">Laporan Data Calon Majelis</option>
                            <option value="kriteria">Laporan Kriteria dan Bobot</option>
                            <option value="ranking">Laporan Hasil Perengkingan</option>
                            <option value="spearman">Laporan Pengujian Spearman Rank</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-print"></i> Cetak
                </button>

                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>

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
