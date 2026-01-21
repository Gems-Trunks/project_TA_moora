<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Perengkingan</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            margin: 40px;
        }

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background-color: #f2f2f2;
        }

        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subjudul {
            text-align: center;
            margin-bottom: 20px;
        }

        .ttd {
            margin-top: 50px;
            width: 100%;
        }

        .ttd div {
            width: 30%;
            float: right;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print(); window.onafterprint = closeWindow;">

    <div class="judul">
        LAPORAN HASIL PERENGKINGAN CALON MAJELIS JEMAAT
    </div>

    <div class="subjudul">
        Menggunakan Metode MOORA <br>
        Tanggal Cetak: {{ tanggal($tanggal) }}
    </div>

    <table>
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Calon Majelis</th>
                <th>Nilai Yi</th>
                <th>Peringkat</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $d)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $d->majelis->nama_calon }}</td>
                    <td class="text-center">{{ number_format($d->nilai_yi, 4) }}</td>
                    <td class="text-center">{{ $d->peringkat }}</td>
                    <td class="text-center">
                        {{ $d->keterangan ?? 'Rekomendasi Sistem' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <div>
            <p>{{ tanggal($tanggal) }}</p>
            <p class="fw-bold">Panitia Pemilihan</p>
            <br><br>
            <p>( ____________________ )</p>
        </div>
    </div>
    <script>
        function closeWindow() {
            window.close();
        }
    </script>


</body>

</html>
