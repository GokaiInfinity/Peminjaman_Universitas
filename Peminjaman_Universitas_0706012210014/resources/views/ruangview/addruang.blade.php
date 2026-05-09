<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Ruang</title>
</head>
<body>
    {{-- Tambah Ruang --}}
    <h1>Tambah Ruang</h1>
    <form action="/insertruang" method="POST">
        @csrf
        <label for="nama_ruang">Nama Ruang:</label><br>
        <input type="text" id="nama_ruang" name="nama_ruang" required><br>
        <label for="kapasitas">Kapasitas:</label><br>
        <input type="number" id="kapasitas" name="kapasitas"><br>
        <label for="gedung">Gedung:</label><br>
        <input type="text" id="gedung" name="gedung"><br>
        <label for="lantai">Lantai:</label><br>
        <input type="number" id="lantai" name="lantai"><br>
        <label for="status_ketersediaan">Status Ketersediaan:</label><br>
        <select id="status_ketersediaan" name="status_ketersediaan" required>
            <option value="1">Tersedia</option>
            <option value="0">Tidak Tersedia</option>
        </select><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
</body>
</html>
