<?php

namespace Database\Seeders;

use App\Models\License;
use Illuminate\Database\Seeder;

/**
 * 3 izin & kualifikasi diambil PERSIS dari brosur (01-project-brief.md bagian 5.4).
 * Nomor izin tidak boleh diubah/dikarang.
 */
class LicenseSeeder extends Seeder
{
    public function run(): void
    {
        $licenses = [
            [
                'title' => 'Izin Praktik Konsultan Pajak',
                'number' => 'KP-1145/IP.A/2026',
                'icon' => 'heroicon-o-identification',
            ],
            [
                'title' => 'Izin Kuasa Hukum Pajak',
                'number' => 'KEP-595/IKH/2024',
                'icon' => 'heroicon-o-scale',
            ],
            [
                'title' => 'Izin Kuasa Kepabeanan dan Cukai',
                'number' => 'KEP-1100/PP/IKH/2024',
                'icon' => 'heroicon-o-building-library',
            ],
        ];

        foreach ($licenses as $index => $license) {
            License::updateOrCreate(
                ['number' => $license['number']],
                [
                    'title' => $license['title'],
                    'icon' => $license['icon'],
                    'order' => $index + 1,
                ],
            );
        }
    }
}
