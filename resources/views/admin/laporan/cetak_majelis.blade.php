<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Calon Majelis</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            margin: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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
            margin-bottom: 15px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print(); window.onafterprint = closeWindow;">

    <div class="judul">
        LAPORAN DATA CALON MAJELIS JEMAAT
    </div>

    <p>
        Nama Gereja : <b>Gereja Kristen Contoh</b><br>
        Periode : <b>Tahun {{ date('Y') }}</b><br>
        Tanggal Cetak : {{ tanggal($tanggal) }}
    </p>

    <table>
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Calon</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Lama Jemaat (Tahun)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $m)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $m->nama_calon }}</td>
                    <td class="text-center">{{ $m->jenis_kelamin }}</td>
                    <td class="text-center">{{ $m->usia }}</td>
                    <td class="text-center">{{ $m->lama_menjadi_jemaat }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <table width="100%" style="border:none">
        <tr style="border:none">
            <td width="70%" style='border:none'></td>
            <td class="text-center" style="border:none">
                Ketua Panitia<br><br><br>
                <u>_____________________</u>
            </td>
        </tr>
    </table>
    <script>
        function closeWindow() {
            window.close();
        }
    </script>

</body>

</html>
