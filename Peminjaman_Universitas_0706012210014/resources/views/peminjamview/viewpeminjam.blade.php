<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td><button><a href="/ruang">Lihat Ruang</a></button></td>
            <td><button><a href="/peralatan">Lihat Peralatan</a></button></td>
            <td><button><a href="/peminjam">Lihat Peminjam</a></button></td>
            <td><button><a href="/peminjaman">Form Peminjaman</a></button></td>
        </tr>
    </table>
    <a href="/addpeminjam">Tambah Peminjam</a>
    <h1>Daftar Peminjam</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM/NIK</th>
            <th>No HP</th>
            <th>Jenis Akun</th>
            <th>Aksi</th>
        </tr>
        @foreach ($peminjam as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->nim_nik }}</td>
            <td>{{ $p->no_hp }}</td>
            <td>{{ $p->jenis_akun }}</td>
            <td>
                <button><a href="/editpeminjam/{{ $p->id }}">Edit</a></button>
                <button><a href="/deletepeminjam/{{ $p->id }}"> Hapus Peminjam</a></button>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
