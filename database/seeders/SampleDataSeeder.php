<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\PendaftaranKkn;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Mahasiswa 1 dengan User
        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@student.usm.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
        ]);

        $mahasiswa1 = Mahasiswa::create([
            'user_id' => $user1->id,
            'nim' => '2021010001',
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@student.usm.ac.id',
            'no_telepon' => '081234567890',
            'program_studi' => 'Teknik Informatika',
            'semester' => 6,
            'ipk' => 3.45
        ]);

        PendaftaranKkn::create([
            'mahasiswa_id' => $mahasiswa1->id,
            'periode' => '2024/2025-1',
            'negara_tujuan' => 'Malaysia',
            'universitas_tujuan' => 'University of Malaya',
            'motivasi' => 'Saya sangat tertarik untuk mengikuti program KKN International ini karena ingin mengaplikasikan ilmu yang telah saya pelajari di bangku kuliah untuk membantu masyarakat internasional. Melalui KKN International, saya berharap dapat memberikan kontribusi nyata bagi universitas mitra dan mengembangkan kemampuan soft skill saya seperti komunikasi lintas budaya, kerjasama tim, dan kepemimpinan global.',
            'status' => 'diterima',
            'catatan_admin' => 'Pendaftaran disetujui. Silakan cek email untuk informasi selanjutnya mengenai pembekalan dan visa.'
        ]);

        // Sample Mahasiswa 2 dengan User
        $user2 = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@student.usm.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
        ]);

        $mahasiswa2 = Mahasiswa::create([
            'user_id' => $user2->id,
            'nim' => '2021010002',
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@student.usm.ac.id',
            'no_telepon' => '082345678901',
            'program_studi' => 'Manajemen',
            'semester' => 7,
            'ipk' => 3.78
        ]);

        PendaftaranKkn::create([
            'mahasiswa_id' => $mahasiswa2->id,
            'periode' => '2024/2025-1',
            'negara_tujuan' => 'Thailand',
            'universitas_tujuan' => 'Chulalongkorn University',
            'motivasi' => 'Saya ingin mengikuti KKN International untuk memperluas wawasan global dan memahami perbedaan budaya bisnis internasional. Pengalaman ini akan sangat berharga untuk pengembangan karir saya di masa depan, terutama dalam konteks bisnis ASEAN. Saya juga ingin membuktikan kemampuan adaptasi saya di lingkungan yang berbeda.',
            'status' => 'diproses',
            'catatan_admin' => 'Sedang dalam tahap verifikasi dokumen dan koordinasi dengan universitas tujuan.'
        ]);

        // Sample Mahasiswa 3 dengan User
        $user3 = User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@student.usm.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
        ]);

        $mahasiswa3 = Mahasiswa::create([
            'user_id' => $user3->id,
            'nim' => '2021010003',
            'nama' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@student.usm.ac.id',
            'no_telepon' => '083456789012',
            'program_studi' => 'Hukum',
            'semester' => 6,
            'ipk' => 3.21
        ]);

        PendaftaranKkn::create([
            'mahasiswa_id' => $mahasiswa3->id,
            'periode' => '2024/2025-1',
            'negara_tujuan' => 'Singapura',
            'universitas_tujuan' => 'National University of Singapore',
            'motivasi' => 'KKN International adalah kesempatan emas untuk terjun langsung memahami sistem hukum internasional. Saya ingin belajar tentang perbedaan sistem hukum di negara lain dan bagaimana hukum diterapkan dalam konteks global. Pengalaman ini akan memperkaya pemahaman saya tentang perbandingan hukum internasional.',
            'status' => 'pending'
        ]);

        $this->command->info('Sample data created successfully!');
        $this->command->info('- 3 Users (Mahasiswa)');
        $this->command->info('- 3 Mahasiswa');
        $this->command->info('- 3 Pendaftaran KKN International');
        $this->command->info('');
        $this->command->info('Login Mahasiswa:');
        $this->command->info('Email: budi.santoso@student.usm.ac.id | Password: password123');
        $this->command->info('Email: siti.nurhaliza@student.usm.ac.id | Password: password123');
        $this->command->info('Email: ahmad.fauzi@student.usm.ac.id | Password: password123');
    }
}