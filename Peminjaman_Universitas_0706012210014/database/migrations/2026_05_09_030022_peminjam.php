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
        Schema::create('peminjams',function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim_nik')->unique();
            $table->string('no_hp');
            $table->enum('jenis_akun', ['mahasiswa', 'dosen']);
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
