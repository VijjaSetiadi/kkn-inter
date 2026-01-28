<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user or create one
        $admin = User::where('role', 'admin')->first();
        
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        $newsData = [
            [
                'title' => 'Driving Global Excellence: DRKUI UMS Aligns Study Programs for Internationalization',
                'slug' => 'driving-global-excellence-drkui-ums-aligns-study-programs',
                'excerpt' => 'Direktorat Reputasi, Kemitraan, dan Urusan Internasional (DRKUI) Universitas Muhammadiyah Surakarta (UMS) held an Internationalization Program Coordination Meeting at the 7th Floor...',
                'content' => "Surakarta, 16 December 2025 — Direktorat Reputasi, Kemitraan, dan Urusan Internasional (DRKUI) Universitas Muhammadiyah Surakarta (UMS) held an Internationalization Program Coordination Meeting at the 7th Floor of the Rectorate Building.\n\nThe meeting aimed to enhance coordination and alignment of internationalization programs across all study programs at UMS. This initiative is part of UMS's commitment to achieving global excellence in higher education.\n\nKey discussions included strategies for international partnerships, student exchange programs, and curriculum development that meets international standards. The meeting was attended by program coordinators, faculty representatives, and international relations officers.\n\n\"This coordination meeting is crucial for ensuring that all our study programs are aligned with our internationalization goals,\" stated the Director of DRKUI. \"We are committed to providing our students with world-class education and global opportunities.\"",
                'published_date' => now()->subDays(5),
                'status' => 'published',
                'views' => 245,
            ],
            [
                'title' => 'Towards Stronger Global Standing: UMS Sets Strategic Roadmap for QS WUR 2027',
                'slug' => 'towards-stronger-global-standing-ums-sets-strategic-roadmap',
                'excerpt' => 'Universitas Muhammadiyah Surakarta (UMS) reaffirmed its dedication to strengthening global recognition through active participation in international ranking schemes, particularly the...',
                'content' => "Surakarta, 6 December 2025 — Universitas Muhammadiyah Surakarta (UMS) reaffirmed its dedication to strengthening global recognition through active participation in international ranking schemes, particularly the QS World University Rankings (QS WUR).\n\nA strategic planning meeting was held to outline the university's roadmap for improving its position in the QS WUR 2027. The comprehensive plan includes initiatives to enhance research output, international collaborations, and academic reputation.\n\nThe meeting brought together key stakeholders including academic leaders, researchers, and administrative staff to discuss concrete action plans. Focus areas include improving citation metrics, increasing international research collaborations, and enhancing student-faculty ratios.\n\n\"Our goal is to position UMS among the top universities in Southeast Asia,\" explained the Rector. \"This requires a coordinated effort across all departments and a strong commitment to excellence in teaching, research, and community service.\"",
                'published_date' => now()->subDays(14),
                'status' => 'published',
                'views' => 312,
            ],
            [
                'title' => 'Building Future Innovators: UMS Hosts FGD on Artificial Intelligence Talent Factory',
                'slug' => 'building-future-innovators-ums-hosts-fgd-artificial-intelligence',
                'excerpt' => 'Universitas Muhammadiyah Surakarta (UMS) strengthened its position as an innovation-driven university by organizing a Focus Group Discussion (FGD) titled "Artificial Intelligence Talent Factory"...',
                'content' => "Surakarta, 24 November 2025 — Universitas Muhammadiyah Surakarta (UMS) strengthened its position as an innovation-driven university by organizing a Focus Group Discussion (FGD) titled \"Artificial Intelligence Talent Factory\".\n\nThe FGD brought together experts from industry, academia, and government to discuss strategies for developing AI talents that meet industry demands. Participants explored curriculum development, practical training programs, and industry partnerships.\n\nKey topics included the integration of AI technologies in education, the development of AI-focused research centers, and strategies for preparing students for the AI-driven job market.\n\n\"Artificial Intelligence is transforming every sector,\" noted a participating industry expert. \"Universities must adapt their programs to ensure graduates are equipped with the necessary AI skills and competencies.\"\n\nThe event concluded with actionable recommendations for implementing an AI talent development program at UMS, including the establishment of AI labs, industry internships, and certification programs.",
                'published_date' => now()->subDays(57),
                'status' => 'published',
                'views' => 189,
            ],
        ];

        foreach ($newsData as $news) {
            News::create(array_merge($news, [
                'author_id' => $admin->id,
            ]));
        }

        $this->command->info('News seeded successfully!');
    }
}