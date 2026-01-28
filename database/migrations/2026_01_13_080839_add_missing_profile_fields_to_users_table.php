<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek dan tambahkan kolom yang belum ada
            if (!Schema::hasColumn('users', 'no_telepon')) {
                $table->string('no_telepon')->nullable()->after('phone');
            }
            
            if (!Schema::hasColumn('users', 'semester')) {
                $table->integer('semester')->nullable()->after('program_studi');
            }
            
            if (!Schema::hasColumn('users', 'ipk')) {
                $table->decimal('ipk', 3, 2)->nullable()->after('semester');
            }
            
            if (!Schema::hasColumn('users', 'alamat_lengkap')) {
                $table->text('alamat_lengkap')->nullable()->after('alamat');
            }
            
            if (!Schema::hasColumn('users', 'foto_profil')) {
                $table->string('foto_profil')->nullable()->after('jenis_kelamin');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'no_telepon',
                'semester',
                'ipk',
                'alamat_lengkap',
                'foto_profil'
            ]);
        });
    }
};