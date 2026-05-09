<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman #{{ $peminjaman->id }}</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { border-bottom: 2px solid #eee; margin-bottom: 20px; padding-bottom: 10px; }
        .status-badge { padding: 5px 10px; border-radius: 4px; color: white; font-weight: bold; }
        .bg-warning { background-color: #f39c12; }
        .bg-success { background-color: #27ae60; }
        .bg-danger { background-color: #e74c3c; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f9f9f9; }
        .action-btns { margin-top: 20px; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block; cursor: pointer; border: none; }
        .btn-back { background: #95a5a6; color: white; }
        .btn-approve { background: #27ae60; color: white; }
        .btn-reject { background: #e74c3c; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Detail Peminjaman #{{ $peminjaman->id }}</h2>
        <span class="status-badge {{ $peminjaman->status == 'disetujui' ? 'bg-success' : ($peminjaman->status == 'ditolak' ? 'bg-danger' : 'bg-warning') }}">
            Status: {{ ucfirst($peminjaman->status) }}
        </span>
    </div>

    <div class="info-section">
        <h3>Informasi Peminjam & Ruang</h3>
        <p><strong>Nama Peminjam:</strong> {{ $peminjaman->peminjam->nama }} ({{ ucfirst($peminjaman->peminjam->jenis_akun) }})</p>
        <p><strong>Identitas:</strong> {{ $peminjaman->peminjam->nomor_identitas }}</p>
        <p><strong>Ruang:</strong> {{ $peminjaman->ruang->nama_ruang }} (Gedung {{ $peminjaman->ruang->gedung }}, Lantai {{ $peminjaman->ruang->lantai }})</p>
        <p><strong>Tanggal Pakai:</strong> {{ $peminjaman->tgl_pakai }} ({{ $peminjaman->durasi_jam }} Jam)</p>
        <p><strong>Keperluan:</strong> {{ $peminjaman->keperluan }}</p>
    </div>

    <div class="item-section">
        <h3>Daftar Peralatan</h3>
        <table>
            <thead>
                <tr>
                    <th>Kode Alat</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Jumlah Pinjam</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman->peralatans as $alat)
                <tr>
                    <td>{{ $alat->kode_peralatan }}</td>
                    <td>{{ $alat->nama_peralatan }}</td>
                    <td>{{ $alat->kategori }}</td>
                    <td>{{ $alat->pivot->jumlah_pinjam }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada peralatan yang dipinjam.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="action-btns">
        <a href="{{ route('peminjaman.index') }}" class="btn btn-back">Kembali ke Daftar</a>

        @if($peminjaman->status == 'menunggu')
            <form action="{{ route('peminjaman.terima', $peminjaman->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-approve" onclick="return confirm('Setujui dan potong stok?')">Setujui Peminjaman</button>
            </form>

            <form action="{{ route('peminjaman.tolak', $peminjaman->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-reject" onclick="return confirm('Tolak peminjaman ini?')">Tolak Peminjaman</button>
            </form>

        @elseif($peminjaman->status == 'disetujui')
            <div style="margin-top: 20px; padding: 15px; border: 1px solid #27ae60; border-radius: 5px; background-color: #e9f7ef;">
                <h4 style="margin-top: 0;">Selesaikan Peminjaman & Kembalikan Barang</h4>
                <form action="{{ route('peminjaman.kembali', $peminjaman->id) }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 10px;">
                        <label for="waktu_kembali_aktual"><strong>Waktu Dikembalikan:</strong></label>
                        {{-- Input datetime-local agar admin bisa mengisi tanggal & jam --}}
                        <input type="datetime-local" name="waktu_kembali_aktual" id="waktu_kembali_aktual" required style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                    </div>
                    <button type="submit" class="btn btn-approve" onclick="return confirm('Selesaikan peminjaman dan kembalikan stok?')">
                        Tandai Selesai & Kembalikan Stok
                    </button>
                </form>
            </div>
        @endif
    </div>
</body>
</html>
