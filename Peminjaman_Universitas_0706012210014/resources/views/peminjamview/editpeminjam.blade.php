<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Peminjam</h1>
    <form action="/updatepeminjam/{{ $peminjam->id }}" method="POST">
        @csrf
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ $peminjam->nama }}" required><br><br>

        <label for="nim_nik">NIM/NIK:</label>
        <input type="text" id="nim_nik" name="nim_nik" value="{{ $peminjam->nim_nik }}" required><br><br>

        <label for="no_hp">No HP:</label>
        <input type="text" id="no_hp" name="no_hp" value="{{ $peminjam->no_hp }}" required><br><br>

        <label for="jenis_akun">Jenis Akun:</label>
        <input type="text" id="jenis_akun" name="jenis_akun" value="{{ $peminjam->jenis_akun }}" required><br><br>

        <button type="submit">Update</button>
</body>
</html>
