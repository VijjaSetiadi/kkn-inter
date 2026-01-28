<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pendaftaran_kkn', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['mahasiswa_id']);
        });
    }

    public function down()
    {
        Schema::table('pendaftaran_kkn', function (Blueprint $table) {
            // Restore foreign key jika rollback
            $table->foreign('mahasiswa_id')
                  ->references('id')
                  ->on('mahasiswa')
                  ->onDelete('cascade');
        });
    }
};