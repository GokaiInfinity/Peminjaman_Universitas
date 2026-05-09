<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import Model di sini
use App\Models\Ruang;
use App\Models\Peralatan;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Http\Requests\StorePeminjamanRequest;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
// Jika Anda menggunakan transaksi DB atau Carbon untuk waktu:
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
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
                    echo "Alat: {$alat->nama_peralatan}, Stok: {$alat->stok}, Jumlah Pinjam: {$jumlah}"; // Debug

                    if ($alat->stok < $jumlah) {
                        throw new \Exception("Stok alat {$alat->nama_peralatan} tidak mencukupi.");
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
        return view('/peminjaman/viewpeminjaman', compact('peminjamans'));
    }

    public function detail($id)
    {
    // Eager load juga relasi peminjam dan ruang agar tidak error saat dipanggil di blade
    $peminjaman = Peminjaman::with(['peralatans', 'peminjam', 'ruang'])->findOrFail($id);

    // Perbaikan: Gunakan 'peminjaman.detail' (tanpa slash di depan)
    return view('peminjaman.detail', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('peralatans')->findOrFail($id);
        $ruangs = Ruang::all();
        $peralatans = Peralatan::all();
        $peminjams = Peminjam::all();

        return redirect('/peminjaman/editpeminjaman/' . $id)->with(compact('peminjaman', 'ruangs', 'peralatans', 'peminjams'));
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

        return redirect('/peminjaman/viewpeminjaman')->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    public function terima($id)
    {
        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::with('peralatans')->findOrFail($id);

            if ($peminjaman->status !== 'menunggu') {
                throw new \Exception("Hanya peminjaman dengan status 'menunggu' yang dapat disetujui.");
            }

            // 1. Lakukan Decrement Stok untuk setiap peralatan yang dipinjam
            foreach ($peminjaman->peralatans as $alat) {
                $jumlahPinjam = $alat->pivot->jumlah_pinjam;

                if ($alat->stok < $jumlahPinjam) {
                    throw new \Exception("Stok alat {$alat->nama_peralatan} tidak cukup untuk disetujui.");
                }

                // Kurangi stok barang
                $alat->decrement('stok', $jumlahPinjam);
            }

            // 2. Update Status Peminjaman
            $peminjaman->update(['status' => 'disetujui']);

            DB::commit();
            return back()->with('success', 'Peminjaman disetujui dan stok barang telah dikurangi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'ditolak']);

        return back()->with('success', 'Peminjaman telah ditolak.');
    }

    public function kembalikan(Request $request, $id)
    {
        // Validasi input waktu
        $request->validate([
            'waktu_kembali_aktual' => 'required|date'
        ]);

        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::with('peralatans')->findOrFail($id);

            if ($peminjaman->status !== 'disetujui') {
                throw new \Exception("Hanya peminjaman dengan status 'disetujui' yang bisa dikembalikan.");
            }

            // 1. Lakukan Increment Stok (Kembalikan stok barang)
            foreach ($peminjaman->peralatans as $alat) {
                $jumlahPinjam = $alat->pivot->jumlah_pinjam;
                $alat->increment('stok', $jumlahPinjam);
            }

            // 2. Update Status dan Waktu Kembali Aktual
            $peminjaman->update([
                'status' => 'selesai',
                'waktu_kembali_aktual' => $request->waktu_kembali_aktual
            ]);

            DB::commit();
            return back()->with('success', 'Peminjaman telah selesai, waktu dicatat, dan stok barang dikembalikan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function exportExcel()
    {
        return Excel::download(new PeminjamanExport, 'laporan-peminjaman.xlsx');
    }
    public function exportPdf()
    {
        $peminjaman = Peminjaman::with(['peminjam', 'ruang', 'peralatans'])->get();

        // Memanggil view khusus cetak
        $pdf = Pdf::loadView('peminjaman.pdf', compact('peminjaman'));

        return $pdf->download('laporan-peminjaman.pdf');
    }
}
