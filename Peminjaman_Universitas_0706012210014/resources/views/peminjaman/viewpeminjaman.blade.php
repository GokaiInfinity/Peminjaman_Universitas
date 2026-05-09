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

    <table>
        <tr>
            <td><button><a href="/ruang">Lihat Ruang</a></button></td>
            <td><button><a href="/peralatan">Lihat Peralatan</a></button></td>
            <td><button><a href="/peminjam">Lihat Peminjam</a></button></td>
            <td><button><a href="/peminjaman">Form Peminjaman</a></button></td>
            <td><button><a href="/peminjaman/viewpeminjaman">View Peminjaman</a></button></td>
        </tr>
    </table>

    <table class="table" border="1">
        <thead>
            <tr>
                <th>Tgl Pengajuan</th>
                <th>Peminjam</th>
                <th>Ruang</th>
                <th>Tgl Pakai</th>
                <th>Status</th>
                <th colspan="4">Aksi</th>
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
                {{-- <td>
                    <a href="/peminjaman/edit/{{ $pj->id }}" class="btn btn-sm btn-primary">Edit</a>
                </td> --}}
                <td>
                <div style="display: flex; gap: 5px;">
                    <a href="/peminjaman/detail/{{ $pj->id }}" class="btn btn-sm btn-primary">Detail</a>
                </div>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
