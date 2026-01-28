<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('label');
            $table->string('type')->default('text'); // text, boolean, date, textarea
            $table->timestamps();
        });
        
        // Insert default settings
        DB::table('settings')->insert([
            [
                'key' => 'registration_open',
                'value' => '1',
                'label' => 'Status Pendaftaran',
                'type' => 'boolean',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'registration_start_date',
                'value' => now()->format('Y-m-d'),
                'label' => 'Tanggal Buka Pendaftaran',
                'type' => 'date',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'registration_end_date',
                'value' => now()->addMonths(3)->format('Y-m-d'),
                'label' => 'Tanggal Tutup Pendaftaran',
                'type' => 'date',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'registration_message',
                'value' => 'Pendaftaran KKN International dibuka! Daftar sekarang dan raih kesempatan belajar di luar negeri.',
                'label' => 'Pesan Pendaftaran',
                'type' => 'textarea',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};