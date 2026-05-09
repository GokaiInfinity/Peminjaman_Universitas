<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import Model di sini
use App\Models\Ruang;
use App\Models\Peralatan;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Http\Requests\StorePeminjamanRequest;
// Jika Anda menggunakan transaksi DB atau Carbon untuk waktu:
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function create()
    {
        $ruangs = Ruang::where('status_ketersediaan', true)->get();
        $peralatans = Peralatan::where('stok', '>', 0)->get();
        $peminjams = Peminjam::all(); // Jika peminjam tidak otomatis dari User Login

        return view('peminjaman.create', compact('ruangs', 'peralatans', 'peminjams'));
    }


    public function store(StorePeminjamanRequest $request)
{
    try {
        DB::beginTransaction();

        // 1. Ambil data yang sudah divalidasi
        $data = $request->validated();

        // 2. Tambahkan data otomatis yang tidak diinput user lewat form
        $data['tgl_pengajuan'] = now(); // Mengisi tgl_pengajuan dengan waktu sekarang
        $data['status'] = 'menunggu';   // Default status awal

        // 3. Masukkan ke tabel peminjaman
        $peminjaman = Peminjaman::create($data);

        // 4. Proses Peralatan jika ada
        if ($request->has('peralatan_id')) {
            foreach ($request->peralatan_id as $index => $alatId) {
                if (!$alatId) continue;

                $jumlah = $request->jumlah_pinjam[$index];

                // Cari alat dan cek stok
                $alat = Peralatan::findOrFail($alatId);

                if ($alat->stok < $jumlah) {
                    throw new \Exception("Stok alat {$alat->nama_alat} tidak mencukupi.");
                }

                // Simpan ke tabel pivot (detail_peralatans)
                $peminjaman->peralatans()->attach($alatId, [
                    'jumlah_pinjam' => $jumlah
                ]);
            }
        }

        DB::commit();
        return redirect('/peminjaman')->with('success', 'Peminjaman berhasil diajukan!');

    } catch (\Exception $e) {
        DB::rollBack();
        // Mengembalikan pesan error spesifik jika stok tidak cukup atau ada masalah DB
        return back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
}
    public function index()
    {
        // Menggunakan eager loading (with) untuk mencegah N+1 problem
        $peminjamans = Peminjaman::with(['peminjam', 'ruang'])->orderBy('tgl_pengajuan', 'desc')->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('peralatans')->findOrFail($id);
        $ruangs = Ruang::all();
        $peralatans = Peralatan::all();
        $peminjams = Peminjam::all();

        return view('peminjaman.edit', compact('peminjaman', 'ruangs', 'peralatans', 'peminjams'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Validasi sederhana
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak,selesai',
            'waktu_kembali_aktual' => 'nullable|date',
        ]);

        $peminjaman->update($request->only(['status', 'waktu_kembali_aktual', 'keperluan']));

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui!');
    }
}
