<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pendaftaran_kkn', function (Blueprint $table) {
            $table->string('barcode_number')->unique()->nullable();
        });
    }

    public function down()
    {
        Schema::table('pendaftaran_kkn', function (Blueprint $table) {
            $table->dropColumn('barcode_number');
        });
    }
};