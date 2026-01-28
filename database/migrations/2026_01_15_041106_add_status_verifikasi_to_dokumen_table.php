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
        Schema::table('dokumen', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['pending', 'diterima', 'ditolak'])
                  ->default('pending')
                  ->after('path_file');
            $table->text('catatan_verifikasi')->nullable()->after('status_verifikasi');
            $table->timestamp('verified_at')->nullable()->after('catatan_verifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen', function (Blueprint $table) {
            $table->dropColumn(['status_verifikasi', 'catatan_verifikasi', 'verified_at']);
        });
    }
};