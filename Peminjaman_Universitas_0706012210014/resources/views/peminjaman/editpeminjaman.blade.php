<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Peminjaman</title>
</head>
<body>
    <div class="container">
    <h2>Edit Peminjaman #{{ $peminjaman->id }}</h2>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Peminjam</label>
                <input type="text" class="form-control" value="{{ $peminjaman->peminjam->nama }}" disabled>
            </div>
            <div class="col-md-6 mb-3">
                <label>Status Peminjaman</label>
                <select name="status" class="form-control">
                    <option value="menunggu" {{ $peminjaman->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ $peminjaman->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="selesai" {{ $peminjaman->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Peralatan yang Dipinjam:</label>
            <ul>
                @foreach($peminjaman->peralatans as $alat)
                    <li>{{ $alat->nama_alat }} (Jumlah: {{ $alat->pivot->jumlah_pinjam }})</li>
                @endforeach
            </ul>
        </div>

        <div class="mb-3">
            <label>Waktu Pengembalian Aktual (Jika Selesai)</label>
            <input type="datetime-local" name="waktu_kembali_aktual" class="form-local" value="{{ $peminjaman->waktu_kembali_aktual }}">
        </div>

        <div class="mb-3">
            <label>Catatan / Keperluan</label>
            <textarea name="keperluan" class="form-control">{{ $peminjaman->keperluan }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Peminjaman</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    </div>
</body>
</html>
