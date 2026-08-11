<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * 6 layanan diambil PERSIS dari brosur (01-project-brief.md bagian 5.3).
 * Jangan mengubah teks title/description agar konsisten dengan brosur resmi.
 * Ikon adalah key Heroicon (dapat diubah admin lewat panel).
 */
class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Konsultasi Pajak',
                'description' => 'Memberikan konsultasi perpajakan yang komprehensif dan solusi atas permasalahan perpajakan perusahaan Anda.',
                'icon' => 'heroicon-o-chat-bubble-left-right',
            ],
            [
                'title' => 'Tax Review & Tax Planning',
                'description' => 'Review kepatuhan pajak dan perencanaan pajak (tax planning) yang efektif, efisien, dan sesuai ketentuan.',
                'icon' => 'heroicon-o-clipboard-document-check',
            ],
            [
                'title' => 'Penyusunan & Pelaporan SPT',
                'description' => 'Menyusun dan melaporkan SPT Masa maupun Tahunan dengan akurat dan tepat waktu.',
                'icon' => 'heroicon-o-document-text',
            ],
            [
                'title' => 'Pendampingan Pemeriksaan',
                'description' => 'Pendampingan dalam pemeriksaan pajak, klarifikasi data, hingga penyelesaian administrasi perpajakan.',
                'icon' => 'heroicon-o-magnifying-glass-circle',
            ],
            [
                'title' => 'Keberatan, Banding & Gugatan',
                'description' => 'Mewakili dan mendampingi Wajib Pajak dalam proses keberatan, banding, hingga gugatan di Pengadilan Pajak.',
                'icon' => 'heroicon-o-scale',
            ],
            [
                'title' => 'Pendampingan Restitusi',
                'description' => 'Bantuan pengajuan restitusi pajak lebih bayar dan percepatan proses pengembaliannya.',
                'icon' => 'heroicon-o-banknotes',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::updateOrCreate(
                ['slug' => Str::slug($service['title'])],
                [
                    'title' => $service['title'],
                    'description' => $service['description'],
                    'icon' => $service['icon'],
                    'order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }
    }
}
