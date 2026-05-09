<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_pakai');
            $table->string('durasi_peminjaman');
            $table->string('status_pengajuan');
            $table->string('catatan_waktu_pengembalian_aktual')->nullable();
            $table->string('keterangan_keperluan_kegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
