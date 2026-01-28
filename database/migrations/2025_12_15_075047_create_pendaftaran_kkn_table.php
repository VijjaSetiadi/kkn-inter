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
    Schema::create('pendaftaran_kkn', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
        $table->string('periode'); // Contoh: 2024/2025-1
        $table->enum('jenis_kkn', ['dalam_negeri', 'luar_negeri']);
        $table->string('negara_tujuan')->nullable();
        $table->string('universitas_tujuan')->nullable();
        $table->text('motivasi');
        $table->enum('status', ['pending', 'diproses', 'diterima', 'ditolak'])->default('pending');
        $table->text('catatan_admin')->nullable();
        $table->timestamp('tanggal_daftar')->useCurrent();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_kkn');
    }
};
