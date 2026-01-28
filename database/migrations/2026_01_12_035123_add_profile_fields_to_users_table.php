<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek apakah kolom sudah ada sebelum menambahkan
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable()->after('email');
            }
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
            if (!Schema::hasColumn('users', 'profile_completed_at')) {
                $table->timestamp('profile_completed_at')->nullable()->after('email_verified_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'name', 'nim', 'phone', 'program_studi', 'fakultas', 
                'angkatan', 'alamat', 'tempat_lahir', 'tanggal_lahir', 
                'jenis_kelamin', 'profile_completed_at'
            ]);
        });
    }
};