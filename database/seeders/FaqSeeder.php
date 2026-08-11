<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

/**
 * 10 FAQ draft dari 05-placeholder-content-pajak.md bagian 1.
 *
 * PENTING: semua disimpan dengan is_active = false (DRAFT).
 * Wajib direview & diaktifkan manual oleh Bapak Yani sebelum tayang ke publik,
 * karena menyangkut informasi resmi perpajakan.
 */
class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['category' => 'Umum', 'question' => 'Apa saja layanan yang ditawarkan Kantor Konsultan Pajak Muhammad Yani?', 'answer' => 'Kami menyediakan layanan konsultasi pajak, tax review & tax planning, penyusunan & pelaporan SPT, pendampingan pemeriksaan pajak, keberatan/banding/gugatan, serta pendampingan restitusi pajak. Detail lengkap dapat dilihat di bagian Layanan Kami.'],
            ['category' => 'Umum', 'question' => 'Apakah konsultasi awal berbayar?', 'answer' => 'Silakan hubungi kami melalui form kontak, WhatsApp, atau email untuk informasi lebih lanjut mengenai skema konsultasi.'],
            ['category' => 'SPT', 'question' => 'Apa perbedaan SPT Masa dan SPT Tahunan?', 'answer' => 'SPT Masa dilaporkan secara berkala (bulanan) untuk jenis pajak tertentu seperti PPN dan PPh Pasal 21, sedangkan SPT Tahunan dilaporkan sekali dalam setahun untuk melaporkan seluruh penghasilan dan pajak terutang selama satu tahun pajak.'],
            ['category' => 'SPT', 'question' => 'Kapan batas waktu lapor SPT Tahunan Orang Pribadi?', 'answer' => 'Umumnya paling lambat akhir Maret setiap tahun untuk tahun pajak sebelumnya. Mohon konfirmasi tanggal pasti ke kantor kami karena dapat berubah sesuai ketentuan DJP terbaru.'],
            ['category' => 'SPT', 'question' => 'Kapan batas waktu lapor SPT Tahunan Badan?', 'answer' => 'Umumnya paling lambat akhir April setiap tahun untuk tahun pajak sebelumnya. Mohon konfirmasi tanggal pasti ke kantor kami karena dapat berubah sesuai ketentuan DJP terbaru.'],
            ['category' => 'Pemeriksaan', 'question' => 'Apa yang harus dilakukan jika menerima surat pemeriksaan pajak?', 'answer' => 'Segera hubungi kami agar dapat didampingi sejak awal proses pemeriksaan, termasuk penyiapan dokumen dan klarifikasi data ke pihak otoritas pajak.'],
            ['category' => 'Keberatan', 'question' => 'Bagaimana proses mengajukan keberatan pajak?', 'answer' => 'Keberatan diajukan secara tertulis ke Direktorat Jenderal Pajak dalam jangka waktu tertentu setelah surat ketetapan pajak diterima. Kami dapat membantu menyusun dan mendampingi proses ini. Hubungi kami untuk detail tenggat waktu sesuai kasus Anda.'],
            ['category' => 'Restitusi', 'question' => 'Apa itu restitusi pajak?', 'answer' => 'Restitusi adalah pengembalian kelebihan pembayaran pajak kepada Wajib Pajak. Kami membantu proses pengajuan hingga percepatan pencairan restitusi tersebut.'],
            ['category' => 'Legalitas', 'question' => 'Apakah kantor ini memiliki izin resmi?', 'answer' => 'Ya, kami memiliki Izin Praktik Konsultan Pajak, Izin Kuasa Hukum Pajak, dan Izin Kuasa Kepabeanan dan Cukai. Nomor izin dapat dilihat di bagian Izin & Kualifikasi pada website ini.'],
            ['category' => 'Kontak', 'question' => 'Bagaimana cara menghubungi kantor untuk konsultasi?', 'answer' => 'Anda dapat menghubungi kami melalui form kontak di website ini, WhatsApp, telepon, atau email yang tercantum di bagian Kontak.'],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                [
                    'answer' => $faq['answer'],
                    'category' => $faq['category'],
                    'order' => $index + 1,
                    'is_active' => false, // DRAFT
                ],
            );
        }
    }
}
