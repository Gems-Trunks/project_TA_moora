<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengujian Spearman Rank</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            margin: 40px;
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

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>

<body onload="window.print(); window.onafterprint = closeWindow;">

    <div class="judul">
        LAPORAN PENGUJIAN KORELASI SPEARMAN RANK
    </div>

    <p>
        Metode SPK : <b>MOORA</b><br>
        Tanggal Cetak : {{ tanggal($tanggal) }}
    </p>

    <table>
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Calon</th>
                <th>Rank MOORA</th>
                <th>Rank Manual</th>
                <th>d</th>
                <th>d²</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $row)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $row->majelis->nama_calon }}</td>
                    <td class="text-center">{{ number_format($row->nilai_sistem, 0) }}</td>
                    <td class="text-center">{{ number_format($row->nilai_manual, 0) }}</td>
                    <td class="text-center">{{ $row->d }}</td>
                    <td class="text-center">{{ $row->d_kuadrat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <p>
        Jumlah Data (n) = {{ $n }} <br>
        Σd² = {{ $sumD2 }} <br>
        Nilai Korelasi (ρ) = <b>{{ number_format($rho, 4) }}</b>
    </p>

    <p class="fw-bold">
        Interpretasi:
        @if ($rho >= 0.8)
            Korelasi Sangat Kuat
        @elseif ($rho >= 0.6)
            Korelasi Kuat
        @elseif ($rho >= 0.4)
            Korelasi Sedang
        @elseif ($rho >= 0.2)
            Korelasi Lemah
        @else
            Korelasi Sangat Lemah
        @endif
    </p>

    <p>
        <b>Kesimpulan:</b><br>
        Berdasarkan hasil pengujian Spearman Rank, sistem pendukung keputusan
        memiliki tingkat kesesuaian
        <b>{{ number_format($rho * 100, 2) }}%</b>
        terhadap penilaian manual.
    </p>
    <script>
        function closeWindow() {
            window.close();
        }
    </script>

</body>

</html>
