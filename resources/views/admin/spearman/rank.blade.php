@extends('layouts.app')

@section('judul', 'Form Perankingan Manual')

@section('konten')

    <form action="{{ route('admin.korelasi.rank.store') }}" method="POST">
        @csrf

        <table class="table table-bordered">
            <thead class="bg-light text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Calon</th>
                    <th>Rank MOORA</th>
                    <th>Input Rank Manual</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $row->majelis->nama_calon }}</td>
                        <td class="text-center">{{ $row->peringkat }}</td>
                        <td>
                            <input type="hidden" name="ranking[{{ $i }}][id_calon]" value="{{ $row->id_calon }}">

                            <input type="number" name="ranking[{{ $i }}][peringkat]" class="form-control"
                                min="1" required>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.korelasi.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
