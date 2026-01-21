<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kriteria dan Bobot</title>
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
        LAPORAN KRITERIA DAN BOBOT PENILAIAN
    </div>

    <p>
        Metode SPK : <b>MOORA</b><br>
        Tanggal Cetak : {{ tanggal($tanggal) }}
    </p>

    <table>
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
                <th>Jenis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $k)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $k->nama_kriteria }}</td>
                    <td class="text-center">{{ $k->bobot }}</td>
                    <td class="text-center">
                        {{ ucfirst(strtolower($k->jenis)) }}
                    </td>

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
