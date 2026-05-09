<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Peminjaman</title>
</head>
<body>
    <div class="container">
    <h2>Daftar Peminjaman Ruang & Peralatan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tgl Pengajuan</th>
                <th>Peminjam</th>
                <th>Ruang</th>
                <th>Tgl Pakai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $pj)
            <tr>
                <td>{{ $pj->tgl_pengajuan }}</td>
                <td>{{ $pj->peminjam->nama }}</td>
                <td>{{ $pj->ruang->nama_ruang }}</td>
                <td>{{ $pj->tgl_pakai }}</td>
                <td>
                    <span class="badge @if($pj->status == 'disetujui') bg-success @elseif($pj->status == 'ditolak') bg-danger @else bg-warning @endif">
                        {{ ucfirst($pj->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('peminjaman.edit', $pj->id) }}" class="btn btn-sm btn-primary">Edit / Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
