<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Ruang</title>
</head>
<body>
    <table>
        <tr>
            <td><button><a href="/ruang">Lihat Ruang</a></button></td>
            <td><button><a href="/peralatan">Lihat Peralatan</a></button></td>
            <td><button><a href="/peminjam">Lihat Peminjam</a></button></td>
            <td><button><a href="/peminjaman">Form Peminjaman</a></button></td>
            <td><button><a href="/peminjaman/view">View Peminjaman</a></button></td>
        </tr>
    </table>
    <a href="/addruang">Tambah Ruang</a>
    <h1>Daftar Ruang</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Ruang</th>
            <th>Kapasitas</th>
            <th>Gedung</th>
            <th>Lantai</th>
            <th>Status Ketersediaan</th>
            <th>Aksi</th>
        </tr>
        @foreach ($ruang as $r)
        <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $r->nama_ruang }}</td>
            <td>{{ $r->kapasitas }}</td>
            <td>{{ $r->gedung }}</td>
            <td>{{ $r->lantai }}</td>
            <td>{{ $r->status_ketersediaan == '1' ? 'Tersedia' : 'Tidak Tersedia' }}</td>
            <td>
                <button><a href="/editruang/{{ $r->id }}">Edit</a></button>
                <button><a href="/deleteruang/{{ $r->id }}"> Hapus Ruang</a></button>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
