<?php

namespace App\Http\Controllers;

use App\Models\peminjam;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    // Menampilkan semua peminjam
    public function peminjamView()
    {
        // Mengambil semua data peminjam dari model peminjam
        $peminjams = peminjam::all();

        // Mengembalikan view dengan data peminjam
        return view('peminjamview.viewpeminjam',["peminjam" => $peminjams]);
    }

    // Menampilkan form untuk menambahkan peminjam baru
    public function addPeminjamView()
    {
        // Mengembalikan view untuk menambah peminjam
        return view('peminjamview.addpeminjam');
    }

    // Memasukkan peminjam baru ke database
    public function insertPeminjam(Request $request)
    {
        // Membuat entri peminjam baru di database
        peminjam::create([
            'nama' => $request->nama,
            'nim_nik' => $request->nim_nik,
            'no_hp' => $request->no_hp,
            'jenis_akun' => $request->jenis_akun,
        ]);

        // Kembali ke halaman peminjam setelah penambahan
        return redirect('/peminjam');
    }

    // Menampilkan detail peminjam tertentu berdasarkan id dari table peminjam.
    public function detailPeminjam($peminjam_id)
    {
//
    }

    // // Menampilkan form untuk mengedit peminjam tertentu
    public function editPeminjamView($peminjam_id)
    {
        // Mengambil data peminjam berdasarkan id
        $peminjam = peminjam::find($peminjam_id);

        // Kembali ke halaman edit peminjam dengan data peminjam
        return view('peminjamview.editpeminjam',[
            "peminjam" => $peminjam
        ]);
    }

    // Memperbarui data peminjam tertentu di database
    public function updatePeminjam(Request $request, $peminjam_id)
    {
        // Mengambil data peminjam berdasarkan id
        $peminjam = peminjam::find($peminjam_id);
        // Memperbarui data peminjam dengan data baru dari request
        $peminjam->update([
            'nama' => $request->nama,
            'nim_nik' => $request->nim_nik,
            'no_hp' => $request->no_hp,
            'jenis_akun' => $request->jenis_akun,
        ]);

        // Kembali ke halaman peminjam setelah pembaruan
        return redirect('/peminjam');
    }

    public function deletePeminjam($peminjam_id)
    {
        $peminjam = peminjam::find($peminjam_id);
        $peminjam->delete();

        return redirect('/peminjam');
    }


}
