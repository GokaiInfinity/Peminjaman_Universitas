<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2 style="text-align: center;">Laporan Peminjaman Universitas XYZ</h2>
<table border="1" width="100%" cellpadding="5" cellspacing="0">
    <thead>
        <tr style="background-color: #eee;">
            <th>Tgl Pakai</th>
            <th>Peminjam</th>
            <th>Ruang</th>
            <th>Status</th>
            <th>Alat yang Dipinjam</th>
            <th>Jumlah Dipinjam</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjaman as $pj)
        <tr>
            <td>{{ $pj->tgl_pakai }}</td>
            <td>{{ $pj->peminjam->nama }}</td>
            <td>{{ $pj->ruang->nama_ruang }}</td>
            <td>{{ ucfirst($pj->status) }}</td>
            <td>
                @foreach($pj->peralatans as $alat)
                    {{ $alat->nama_peralatan }}
                @endforeach
            </td>
            <td>
                @foreach($pj->peralatans as $alat)
                    {{ $alat->pivot->jumlah_pinjam }}
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
