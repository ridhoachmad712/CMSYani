<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Muhammad Yani, S.E., Ak., M.Ak., M.H., CTR., CPAFS., BKP.',
                'slug' => 'muhammad-yani',
                'role' => 'Managing Partner / Konsultan Pajak Utama & Kuasa Hukum Pajak',
                'bio' => 'Konsultan Pajak dan Kuasa Hukum Pajak berpengalaman lebih dari 15 tahun dalam bidang kepatuhan pajak, audit perpajakan, tax planning, serta pendampingan sengketa pajak.',
                'detail' => '<p>Muhammad Yani adalah Konsultan Pajak dan Kuasa Hukum Pajak yang memimpin KAP Muhammad Yani &amp; Rekan. Dengan latar belakang akuntansi dan hukum, beliau menangani kepatuhan pajak, perencanaan pajak, hingga pendampingan sengketa di Pengadilan Pajak.</p><p><strong>Keahlian:</strong> Konsultasi Pajak, Tax Review &amp; Tax Planning, Pendampingan Pemeriksaan, Keberatan/Banding/Gugatan, Restitusi, Kepabeanan &amp; Cukai.</p><p><em>Ini adalah konten contoh yang dapat dilengkapi melalui panel admin.</em></p>',
                'email' => 'muh.yani2013@gmail.com',
                'linkedin_url' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Hidayat, S.E., BKP.',
                'slug' => 'ahmad-hidayat',
                'role' => 'Senior Tax Consultant',
                'bio' => 'Spesialis dalam penyusunan SPT Masa/Tahunan, Tax Review, serta pendampingan pemeriksaan pajak untuk sektor UMKM dan korporasi.',
                'detail' => '<p>Ahmad Hidayat menangani penyusunan dan pelaporan SPT, tax review, serta pendampingan pemeriksaan pajak bagi klien UMKM maupun korporasi.</p><p><em>Data contoh (placeholder) yang dapat dilengkapi melalui panel admin.</em></p>',
                'email' => null,
                'linkedin_url' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Ratna Sari, S.H., M.Kn.',
                'slug' => 'ratna-sari',
                'role' => 'Legal & Tax Dispute Specialist',
                'bio' => 'Ahli dalam penanganan administrasi keberatan pajak, banding, dan pendampingan hukum perpajakan bagi Wajib Pajak Badan dan Perorangan.',
                'detail' => '<p>Ratna Sari fokus pada aspek hukum perpajakan: penanganan keberatan, banding, gugatan, serta pendampingan hukum bagi Wajib Pajak Badan dan Perorangan.</p><p><em>Data contoh (placeholder) yang dapat dilengkapi melalui panel admin.</em></p>',
                'email' => null,
                'linkedin_url' => null,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                $member
            );
        }
    }
}
