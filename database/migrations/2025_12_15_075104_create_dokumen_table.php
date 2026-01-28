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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran_kkn')->onDelete('cascade');
            $table->enum('jenis_dokumen', [
                'ktp', 
                'khs', 
                'transkrip', 
                'sertifikat_bahasa', 
                'surat_rekomendasi', 
                'passport', 
                'surat_izin_ortu',           // ← TAMBAHKAN INI
                'bukti_pembayaran',          // ← TAMBAHKAN INI (ganti pas_foto)
                'lainnya'
            ]);
            $table->string('nama_file');
            $table->string('path_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
