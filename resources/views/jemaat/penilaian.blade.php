@extends('layouts.app')
@section('judul', 'Penilaian Calon Majelis')
@section('konten')
    <div class="card">
        <div class="card-header">
            <h5 class="fw-bold">Daftar Calon Majelis untuk Dinilai</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jemaat.penilaian.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label>Pilih Calon Majelis:</label>
                    <select name="id_calon" class="form-select" id="pilihCalon">
                        <option value="" selected disabled>-- Pilih Calon --</option>
                        @foreach ($calonMajelis as $calon)
                            <option value="{{ $calon->id }}" data-nama="{{ $calon->nama_calon }}"
                                data-jk="{{ $calon->jenis_kelamin }}" data-usia="{{ $calon->usia }}"
                                data-lama="{{ $calon->lama_menjadi_jemaat }}">
                                {{ $calon->nama_calon }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="p-3 bg-light mb-4">
                    <p><strong>Nama :</strong> <span id="displayNama">-</span></p>
                    <p><strong>Jenis Kelamin :</strong> <span id="displayJK">-</span></p>
                    <p><strong>Usia :</strong> <span id="displayUsia">-</span></p>
                    <p><strong>Lama Menjadi Jemaat :</strong> <span id="displayLama">-</span></p>
                </div>

                <h5>Penilaian</h5>
                @foreach ($kriteria as $k)
                    @php
                        // Filter: Hanya tampilkan kriteria yang diisi Jemaat
                        $isJemaatKriteria = in_array($k->nama_kriteria, [
                            'Pemahaman Alkitab',
                            'Keaktifan Pelayanan',
                            'Keteladanan',
                        ]);
                    @endphp

                    @if ($isJemaatKriteria)
                        <div class="mb-3 row-12 col-md-6">
                            <label class="form-label"><strong>{{ $k->nama_kriteria }}</strong></label>
                            <select name="nilai[{{ $k->id }}]" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Penilaian --</option>

                                @if ($k->nama_kriteria == 'Pemahaman Alkitab')
                                    <option value="1">Belum Baik (1)</option>
                                    <option value="2">Cukup Baik (2)</option>
                                    <option value="3">Baik (3)</option>
                                    <option value="4">Sangat Baik (4)</option> [cite: 4]
                                @elseif($k->nama_kriteria == 'Keaktifan Pelayanan')
                                    <option value="1">Kurang Aktif (1)</option>
                                    <option value="2">Cukup Aktif (2)</option>
                                    <option value="3">Aktif (3)</option>
                                    <option value="4">Sangat Aktif (4)</option> [cite: 9]
                                @elseif($k->nama_kriteria == 'Keteladanan')
                                    <option value="1">Kurang Baik (1)</option>
                                    <option value="2">Cukup Baik (2)</option>
                                    <option value="3">Baik (3)</option>
                                    <option value="4">Sangat Baik (4)</option> [cite: 14]
                                @endif
                            </select>
                        </div>
                    @endif
                @endforeach

                <div class="mt-4">
                    <a href="{{ route('jemaat.dashboard') }}" class='btn btn-danger'>Batal</a>
                    <button type="submit" class="btn btn-success">Simpan Nilai</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('pilihCalon').addEventListener('change', function() {
            // Ambil elemen option yang sedang dipilih
            const selectedOption = this.options[this.selectedIndex];

            // Ambil data dari atribut data-*
            const nama = selectedOption.getAttribute('data-nama');
            const jk = selectedOption.getAttribute('data-jk');
            const usia = selectedOption.getAttribute('data-usia');
            const lama = selectedOption.getAttribute('data-lama');

            // Update tampilan HTML
            document.getElementById('displayNama').innerText = nama;
            document.getElementById('displayJK').innerText = jk;
            document.getElementById('displayUsia').innerText = usia + " Tahun";
            document.getElementById('displayLama').innerText = lama + " Tahun";
        });
    </script>
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
