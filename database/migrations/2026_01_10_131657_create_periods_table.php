<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "2025/2026 Semester 1"
            $table->string('year'); // e.g., "2025/2026"
            $table->integer('semester'); // 1 or 2
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        
        // Insert sample data
        DB::table('periods')->insert([
            [
                'name' => '2024/2025 Semester 1',
                'year' => '2024/2025',
                'semester' => 1,
                'start_date' => '2024-09-01',
                'end_date' => '2025-01-31',
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2024/2025 Semester 2',
                'year' => '2024/2025',
                'semester' => 2,
                'start_date' => '2025-02-01',
                'end_date' => '2025-06-30',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2025/2026 Semester 1',
                'year' => '2025/2026',
                'semester' => 1,
                'start_date' => '2025-09-01',
                'end_date' => '2026-01-31',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};