<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Ruang</title>
</head>
<body>
    <h1>Tambah Ruang</h1>
    <form action="/insertruang" method="POST">
        @csrf
        <label for="kapasitas">Kapasitas:</label><br>
        <input type="number" id="kapasitas" name="kapasitas"><br>
        <label for="gedung">Gedung:</label><br>
        <input type="text" id="gedung" name="gedung"><br>
        <label for="lantai">Lantai:</label><br>
        <input type="number" id="lantai" name="lantai"><br>
        <label for="status_ketersediaan">Status Ketersediaan:</label><br>
        <input type="text" id="status_ketersediaan" name="status_ketersediaan"><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
</body>
</html>
