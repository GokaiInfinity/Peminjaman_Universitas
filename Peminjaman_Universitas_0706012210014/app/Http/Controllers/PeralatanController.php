<?php

namespace App\Http\Controllers;

use App\Models\peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    // Menampilkan semua peralatan
    public function peralatanView()
    {
        // Mengambil semua data peralatan dari model peralatan
        $peralatans = peralatan::all();

        // Mengembalikan view dengan data peralatan
        return view('peralatanview.viewperalatan',["peralatan" => $peralatans]);
    }

    // Menampilkan form untuk menambahkan peralatan baru
    public function addperalatanView()
    {
        // Mengembalikan view untuk menambah peralatan
        return view('peralatanview.addperalatan');
    }

    // Memasukkan peralatan baru ke database
    public function insertPeralatan(Request $request)
    {
        // Membuat entri peralatan baru di database
        peralatan::create([
            'kode_peralatan' => $request->kode_peralatan,
            'nama_peralatan' => $request->nama_peralatan,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
        ]);

        // Kembali ke halaman peralatan setelah penambahan
        return redirect('/peralatan');
    }

    // Menampilkan detail peralatan tertentu berdasarkan id dari table peralatan.
    public function detailPeralatan($peralatan_id)
    {
//
    }

    // // Menampilkan form untuk mengedit peralatan tertentu
    public function editPeralatanView($peralatan_id)
    {
        // Mengambil data peralatan berdasarkan id
        $peralatan = peralatan::find($peralatan_id);

        // Kembali ke halaman edit peralatan dengan data peralatan
        return view('peralatanview.editperalatan',[
            "peralatan" => $peralatan
        ]);
    }

    // Memperbarui data peralatan tertentu di database
    public function updatePeralatan(Request $request, $peralatan_id)
    {
        // Mengambil data peralatan berdasarkan id
        $peralatan = peralatan::find($peralatan_id);
        // Memperbarui data peralatan dengan data baru dari request
        $peralatan->update([
            'kode_peralatan' => $request->kode_peralatan,
            'nama_peralatan' => $request->nama_peralatan,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
        ]);

        // Kembali ke halaman peralatan setelah pembaruan
        return redirect('/peralatan');
    }

    public function deletePeralatan($peralatan_id)
    {
        $peralatan = peralatan::find($peralatan_id);
        $peralatan->delete();

        return redirect('/peralatan');
    }

}
