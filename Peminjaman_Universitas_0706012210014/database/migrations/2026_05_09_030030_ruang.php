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
        Schema::create('ruangs',function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruang');
            $table->integer('kapasitas');
            $table->integer('lantai');
            $table->string('gedung');
            $table->boolean('status_ketersediaan')->default(true);
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
