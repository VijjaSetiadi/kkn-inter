<?php
// database/migrations/xxxx_remove_jenis_kkn_from_pendaftaran_kkn.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran_kkn', function (Blueprint $table) {
            $table->dropColumn('jenis_kkn');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran_kkn', function (Blueprint $table) {
            $table->enum('jenis_kkn', ['dalam_negeri', 'luar_negeri'])->after('periode');
        });
    }
};