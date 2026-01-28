<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('verification_code', 6)->nullable()->after('password');
            $table->timestamp('verification_code_expires_at')->nullable()->after('verification_code');
            $table->boolean('is_verified')->default(false)->after('verification_code_expires_at');
            $table->timestamp('verified_at')->nullable()->after('is_verified');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'verification_code',
                'verification_code_expires_at',
                'is_verified',
                'verified_at'
            ]);
        });
    }
};