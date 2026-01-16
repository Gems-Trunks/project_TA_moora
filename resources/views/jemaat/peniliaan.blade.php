<div class="card">
    <div class="card-header">
        <h5 class="fw-bold">Daftar Calon Majelis untuk Dinilai</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Calon</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($calons as $c)
                    <tr>
                        <td>{{ $c->nama_calon }}</td>
                        <td>
                            <a href="{{ route('jemaat.penilaian.create', $c->id) }}" class="btn btn-primary btn-sm">
                                Beri Penilaian
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
