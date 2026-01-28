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
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title')->default('Program Beasiswa Luar Negeri');
            $table->text('hero_description')->nullable();
            $table->string('hero_badge')->default('Pendaftaran Dibuka');
            $table->string('hero_image')->nullable();
            
            // Statistics
            $table->integer('stat_countries')->default(50);
            $table->integer('stat_universities')->default(200);
            $table->integer('stat_alumni')->default(5000);
            $table->integer('stat_satisfaction')->default(95);
            
            // Content (stored as JSON)
            $table->json('purposes')->nullable();
            $table->json('requirements')->nullable();
            $table->json('benefits')->nullable();
            $table->json('timelines')->nullable();
            $table->json('documents')->nullable();
            
            // Contact Information
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('contact_address')->nullable();
            
            $table->timestamps();
        });
        
        // Insert default data
        DB::table('information')->insert([
            'hero_title' => 'Program Beasiswa Luar Negeri',
            'hero_description' => 'Wujudkan impian studi di universitas terbaik dunia dengan dukungan penuh dari kami.',
            'hero_badge' => 'Pendaftaran Dibuka',
            'stat_countries' => 50,
            'stat_universities' => 200,
            'stat_alumni' => 5000,
            'stat_satisfaction' => 95,
            'purposes' => json_encode([
                'Meningkatkan kualitas SDM Indonesia melalui pendidikan berkualitas tinggi',
                'Memberikan kesempatan bagi mahasiswa berprestasi untuk studi di luar negeri',
                'Membangun jaringan global untuk pengembangan karir'
            ]),
            'requirements' => json_encode([
                'WNI dengan IPK minimal 3.0',
                'Kemampuan bahasa Inggris (TOEFL/IELTS)',
                'Surat rekomendasi dari dosen atau atasan',
                'Proposal studi yang jelas dan terstruktur'
            ]),
            'benefits' => json_encode([
                ['icon' => 'book-open', 'text' => 'Biaya kuliah penuh'],
                ['icon' => 'home', 'text' => 'Tunjangan tempat tinggal'],
                ['icon' => 'plane', 'text' => 'Tiket pesawat PP'],
                ['icon' => 'heart', 'text' => 'Asuransi kesehatan'],
                ['icon' => 'users', 'text' => 'Mentoring dan networking'],
                ['icon' => 'briefcase', 'text' => 'Career development']
            ]),
            'timelines' => json_encode([
                ['title' => 'Pendaftaran Online', 'description' => 'Isi formulir dan upload dokumen yang diperlukan'],
                ['title' => 'Seleksi Administrasi', 'description' => 'Verifikasi kelengkapan dan keabsahan dokumen'],
                ['title' => 'Tes Tertulis', 'description' => 'Ujian kemampuan akademik dan bahasa'],
                ['title' => 'Wawancara', 'description' => 'Interview dengan panel ahli'],
                ['title' => 'Pengumuman', 'description' => 'Hasil seleksi akan diumumkan via email']
            ]),
            'documents' => json_encode([
                'KTP/Paspor',
                'Ijazah & Transkrip Nilai',
                'Sertifikat TOEFL/IELTS',
                'Surat Rekomendasi (2 buah)',
                'Proposal Studi',
                'CV/Resume',
                'Motivation Letter',
                'Portfolio (jika ada)'
            ]),
            'contact_email' => 'info@beasiswa.ac.id',
            'contact_phone' => '+62 21 1234 5678',
            'contact_address' => 'Jl. Pendidikan No. 123, Jakarta Pusat, DKI Jakarta 10110',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};