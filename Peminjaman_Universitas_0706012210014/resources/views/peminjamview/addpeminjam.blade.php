<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Peminjam</title>
</head>
<body>
    <h1>Tambah Peminjam</h1>
    <form action="/insertpeminjam" method="POST">
        @csrf
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="nim_nik">NIM/NIK:</label>
        <input type="text" id="nim_nik" name="nim_nik" required><br><br>

        <label for="no_hp">No HP:</label>
        <input type="text" id="no_hp" name="no_hp" required><br><br>

        <label for="jenis_akun">Jenis Akun:</label>
        <select id="jenis_akun" name="jenis_akun" required>
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Dosen">Dosen</option>

        </select><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
