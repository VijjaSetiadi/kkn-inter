<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('university');
            $table->text('description')->nullable();
            $table->integer('quota')->default(10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        
        // Insert sample data
        DB::table('destinations')->insert([
            [
                'country' => 'Malaysia',
                'university' => 'University of Malaya',
                'description' => 'Universitas terkemuka di Malaysia dengan program internasional yang berkualitas',
                'quota' => 15,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'country' => 'Thailand',
                'university' => 'Chulalongkorn University',
                'description' => 'Universitas tertua dan terbaik di Thailand',
                'quota' => 10,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'country' => 'Singapore',
                'university' => 'National University of Singapore',
                'description' => 'Universitas top di Asia dengan standar internasional',
                'quota' => 8,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};