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
    <a href="/addperalatan">Tambah Peralatan</a>
    <h1>Daftar Peralatan</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kode Peralatan</th>
            <th>Nama Peralatan</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
        @foreach ($peralatan as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->kode_peralatan }}</td>
            <td>{{ $p->nama_peralatan }}</td>
            <td>{{ $p->stok }}</td>
            <td>{{ $p->kategori }}</td>
            <td>
                <button><a href="/editperalatan/{{ $p->id }}">Edit</a></button>
                <button><a href="/deleteperalatan/{{ $p->id }}"> Hapus Peralatan</a></button>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
