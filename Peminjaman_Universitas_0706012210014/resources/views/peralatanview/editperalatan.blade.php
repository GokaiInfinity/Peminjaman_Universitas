<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Peralatan</h1>
    <form action="/updateperalatan/{{ $peralatan->id }}" method="POST">
        @csrf
        <label for="nama_peralatan">Nama Peralatan:</label>
        <input type="text" id="nama_peralatan" name="nama_peralatan" value="{{ $peralatan->nama_peralatan }}" required><br><br>

        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" value="{{ $peralatan->stok }}" required><br><br>

        <label for="kategori">Kategori:</label>
        <input type="text" id="kategori" name="kategori" value="{{ $peralatan->kategori }}" required><br><br>

        <button type="submit">Update</button>
</body>
</html>
