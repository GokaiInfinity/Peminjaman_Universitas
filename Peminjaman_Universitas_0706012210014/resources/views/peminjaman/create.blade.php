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
            <td><button><a href="/peminjaman/viewpeminjaman">View Peminjaman</a></button></td>
        </tr>
    </table>

    {{-- Memeriksa adanya error saat submit --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- Form Peminjaman --}}
<form action="/peminjaman/store" method="POST">
    @csrf
    {{--Informasi Dasar --}}
    <div class="form-group">
        <label>Peminjam</label>
        <select name="peminjam_id" class="form-control" required>
            @foreach($peminjams as $p)
                <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->jenis_akun }})</option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label>Pilih Ruang</label>
            <select name="ruang_id" class="form-control" required>
                @foreach($ruangs as $r)
                    <option value="{{ $r->id }}">{{ $r->nama_ruang }} - Lantai {{ $r->lantai }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Tanggal Pakai</label>
            <input type="date" name="tgl_pakai" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label>Durasi (Jam)</label>
            <input type="number" name="durasi_jam" class="form-control" min="1" required>
        </div>
    </div>

    <hr>

    {{-- ### Tambah Peralatan (Dynamic) --}}
    <div id="peralatan-container">
        <label>Peralatan yang Dipinjam</label>
        <div class="row peralatan-row mb-2">
            <div class="col-md-7">
                <select name="peralatan_id[]" class="form-control">
                    <option value="">-- Pilih Alat --</option>
                    @foreach($peralatans as $alt)
                        <option value="{{ $alt->id }}">{{ $alt->nama_peralatan }} (Stok: {{ $alt->stok }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="jumlah_pinjam[]" class="form-control" placeholder="Jumlah">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-row">Hapus</button>
            </div>
        </div>
    </div>
    <button type="button" id="add-equipment" class="btn btn-secondary btn-sm">+ Tambah Alat Lain</button>

    <div class="mt-4">
        <label>Keperluan</label>
        <textarea name="keperluan" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Ajukan Peminjaman</button>
</form>

<script>
    // Script sederhana untuk menambah baris peralatan
    document.getElementById('add-equipment').addEventListener('click', function() {
        let container = document.getElementById('peralatan-container');
        let row = document.querySelector('.peralatan-row').cloneNode(true);
        row.querySelector('select').value = "";
        row.querySelector('input').value = "";
        container.appendChild(row);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            if (document.querySelectorAll('.peralatan-row').length > 1) {
                e.target.closest('.peralatan-row').remove();
            }
        }
    });
</script>
</body>
</html>
