<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumen', function (Blueprint $table) {
            // Tracking reupload
            $table->integer('reupload_count')->default(0)->after('verified_at');
            $table->timestamp('last_reuploaded_at')->nullable()->after('reupload_count');
            $table->text('reupload_reason')->nullable()->after('last_reuploaded_at');
            
            // Simpan file lama
            $table->string('old_path_file')->nullable()->after('reupload_reason');
            $table->string('old_nama_file')->nullable()->after('old_path_file');
        });
    }

    public function down(): void
    {
        Schema::table('dokumen', function (Blueprint $table) {
            $table->dropColumn([
                'reupload_count',
                'last_reuploaded_at',
                'reupload_reason',
                'old_path_file',
                'old_nama_file'
            ]);
        });
    }
};