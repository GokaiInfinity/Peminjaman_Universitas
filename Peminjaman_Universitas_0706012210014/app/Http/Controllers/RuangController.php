<?php

namespace App\Http\Controllers;

use App\Models\ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    // Menampilkan semua ruang
    public function ruangView()
    {
        // Mengambil semua data ruang dari model ruang
        $ruangs = ruang::all();

        // Mengembalikan view dengan data ruang
        return view('ruangview.viewruang',["ruang" => $ruangs]);
    }

    // Menampilkan form untuk menambahkan ruang baru
    public function addRuangView()
    {
        // Mengembalikan view untuk menambah ruang
        return view('ruangview.addruang');
    }

    // Memasukkan ruang baru ke database
    public function insertRuang(Request $request)
    {
        // Membuat entri ruang baru di database
        ruang::create([
            'nama_ruang' => $request->nama_ruang,
            'kapasitas' => $request->kapasitas,
            'gedung' => $request->gedung,
            'lantai' => $request->lantai,
            'status_ketersediaan' => $request->status_ketersediaan,
        ]);

        // Kembali ke halaman ruang setelah penambahan
        return redirect('/ruang');
    }

    // Menampilkan form untuk mengedit ruang tertentu
    public function editRuangView($ruang_id)
    {
        // Mengambil data ruang berdasarkan id
        $ruang = ruang::find($ruang_id);

        // Kembali ke halaman edit ruang dengan data ruang
        return view('ruangview.editruang',[
            "ruang" => $ruang
        ]);
    }

    // Memperbarui data ruang tertentu di database
    public function updateRuang(Request $request, $ruang_id)
    {
        // Mengambil data ruang berdasarkan id
        $ruang = ruang::find($ruang_id);
        // Memperbarui data ruang dengan data baru dari request
        $ruang->update([
            'nama_ruang' => $request->nama_ruang,
            'kapasitas' => $request->kapasitas,
            'gedung' => $request->gedung,
            'lantai' => $request->lantai,
            'status_ketersediaan' => $request->status_ketersediaan,
        ]);

        // Kembali ke halaman ruang setelah pembaruan
        return redirect('/ruang');
    }

    public function deleteRuang($ruang_id)
    {
        $ruang = ruang::find($ruang_id);
        $ruang->delete();

        return redirect('/ruang');
    }

}
