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
        Schema::table('users', function (Blueprint $table) {
            // Ubah kolom name jadi nullable
            $table->string('name')->nullable()->change();
            
            // Tambahkan kolom yang dibutuhkan jika belum ada
            if (!Schema::hasColumn('users', 'nim')) {
                $table->string('nim', 20)->nullable()->unique()->after('name');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable()->after('nim');
            }
            if (!Schema::hasColumn('users', 'program_studi')) {
                $table->string('program_studi', 100)->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'fakultas')) {
                $table->string('fakultas', 100)->nullable()->after('program_studi');
            }
            if (!Schema::hasColumn('users', 'angkatan')) {
                $table->integer('angkatan')->nullable()->after('fakultas');
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('angkatan');
            }
            if (!Schema::hasColumn('users', 'tempat_lahir')) {
                $table->string('tempat_lahir', 100)->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('users', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            }
            if (!Schema::hasColumn('users', 'jenis_kelamin')) {
                $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('tanggal_lahir');
            }
            if (!Schema::hasColumn('users', 'verification_code')) {
                $table->string('verification_code', 6)->nullable()->after('email_verified_at');
            }
            if (!Schema::hasColumn('users', 'verification_code_expires_at')) {
                $table->timestamp('verification_code_expires_at')->nullable()->after('verification_code');
            }
            if (!Schema::hasColumn('users', 'profile_completed_at')) {
                $table->timestamp('profile_completed_at')->nullable()->after('jenis_kelamin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            
            // Hapus kolom yang ditambahkan (opsional)
            // $table->dropColumn([
            //     'nim', 'phone', 'program_studi', 'fakultas', 'angkatan',
            //     'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
            //     'verification_code', 'verification_code_expires_at', 'profile_completed_at'
            // ]);
        });
    }
};