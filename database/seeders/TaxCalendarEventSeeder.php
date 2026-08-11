<?php

namespace Database\Seeders;

use App\Models\TaxCalendarEvent;
use Illuminate\Database\Seeder;

/**
 * 7 event kalender pajak draft dari 05-placeholder-content-pajak.md bagian 3.
 * Disimpan is_active = false (DRAFT).
 *
 * PENTING: tanggal jatuh tempo bersifat umum/perkiraan dan HARUS dicek ulang
 * oleh Bapak Yani sebelum tayang (dapat berubah sesuai ketentuan DJP terbaru,
 * dan bergeser bila jatuh pada hari libur/akhir pekan).
 */
class TaxCalendarEventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            ['category' => 'Pembayaran', 'title' => 'Pembayaran PPh Pasal 21', 'due_rule' => 'Paling lambat tanggal 10 bulan berikutnya'],
            ['category' => 'Pembayaran', 'title' => 'Pembayaran PPh Pasal 25 (angsuran)', 'due_rule' => 'Paling lambat tanggal 15 bulan berikutnya'],
            ['category' => 'Pembayaran', 'title' => 'Pembayaran PPN', 'due_rule' => 'Paling lambat akhir bulan berikutnya, sebelum SPT Masa PPN dilaporkan'],
            ['category' => 'SPT Masa', 'title' => 'Lapor SPT Masa PPh Pasal 21', 'due_rule' => 'Paling lambat tanggal 20 bulan berikutnya'],
            ['category' => 'SPT Masa', 'title' => 'Lapor SPT Masa PPN', 'due_rule' => 'Paling lambat akhir bulan berikutnya'],
            ['category' => 'SPT Tahunan', 'title' => 'Lapor SPT Tahunan PPh Orang Pribadi', 'due_rule' => 'Paling lambat akhir Maret tahun berikutnya'],
            ['category' => 'SPT Tahunan', 'title' => 'Lapor SPT Tahunan PPh Badan', 'due_rule' => 'Paling lambat akhir April tahun berikutnya'],
        ];

        foreach ($events as $index => $event) {
            TaxCalendarEvent::updateOrCreate(
                ['title' => $event['title']],
                [
                    'category' => $event['category'],
                    'due_rule' => $event['due_rule'],
                    'order' => $index + 1,
                    'is_active' => false, // DRAFT
                ],
            );
        }
    }
}
