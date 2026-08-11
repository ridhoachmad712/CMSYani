<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

/**
 * Pengaturan situs (single-record) diambil dari brosur
 * (01-project-brief.md bagian 5.1, 5.2, 5.6).
 *
 * Catatan:
 * - instagram_url dikosongkan: link Instagram masih perlu dikonfirmasi ke Bapak Yani.
 * - whatsapp_number memakai format internasional (62...) untuk tautan wa.me,
 *   dikonversi dari nomor primer 0853 4224 1563 -> 6285342241563.
 * - logo_path dikosongkan: sistem menampilkan placeholder sampai logo asli diupload.
 */
class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $aboutText = <<<'TEXT'
        Kantor Konsultan Pajak dan Kuasa Hukum Pajak Muhammad Yani hadir untuk memberikan layanan profesional, independen, dan terpercaya di bidang perpajakan dan hukum pajak bagi perusahaan, individu, maupun instansi.

        Kami berkomitmen menjadi mitra strategis dalam mendukung kepatuhan pajak dan melindungi hak hukum klien secara optimal.
        TEXT;

        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'tagline' => 'Solusi Tepat Kepatuhan Hemat',
                'hero_subtitle' => 'Solusi Profesional untuk Kepatuhan Pajak dan Perlindungan Hukum Bisnis Anda',
                'about_text' => $aboutText,
                'quote_text' => 'Integritas, Profesionalisme, dan Kerahasiaan adalah komitmen kami dalam setiap layanan.',
                'email' => 'muh.yani2013@gmail.com',
                'phone_primary' => '0853 4224 1563',
                'phone_secondary' => '0813 8486 6511',
                'address' => 'Jl. Muhajirin No. 7 Bangkala Manggala, Kota Makassar, Sulawesi Selatan',
                'instagram_url' => null,
                'whatsapp_number' => '6285342241563',
                'logo_path' => null,
            ],
        );
    }
}
