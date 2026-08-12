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
                'role' => 'Managing Partner / Konsultan Pajak Utama & Kuasa Hukum Pajak',
                'bio' => 'Konsultan Pajak dan Kuasa Hukum Pajak berpengalaman lebih dari 15 tahun dalam bidang kepatuhan pajak, audit perpajakan, tax planning, serta pendampingan sengketa pajak.',
                'email' => 'muh.yani2013@gmail.com',
                'linkedin_url' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Hidayat, S.E., BKP.',
                'role' => 'Senior Tax Consultant',
                'bio' => 'Spesialis dalam penyusunan SPT Masa/Tahunan, Tax Review, serta pendampingan pemeriksaan pajak untuk sektor UMKM dan korporasi.',
                'email' => null,
                'linkedin_url' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Ratna Sari, S.H., M.Kn.',
                'role' => 'Legal & Tax Dispute Specialist',
                'bio' => 'Ahli dalam penanganan administrasi keberatan pajak, banding, dan pendampingan hukum perpajakan bagi Wajib Pajak Badan dan Perorangan.',
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
