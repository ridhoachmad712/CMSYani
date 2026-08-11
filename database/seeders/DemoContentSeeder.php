<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Konten DEMO untuk mengisi tampilan (testimoni & artikel) agar landing page
 * terlihat lengkap saat presentasi.
 *
 * PENTING: ini data contoh/dummy. GANTI dengan testimoni & artikel asli,
 * atau hapus, sebelum situs tayang ke publik/produksi.
 */
class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedTestimonials();
        $this->seedArticles();
    }

    private function seedTestimonials(): void
    {
        $items = [
            ['client_name' => 'Budi Santoso', 'client_role' => 'Direktur PT Maju Bersama', 'rating' => 5,
                'content' => 'Pelayanan sangat profesional. Proses pelaporan pajak perusahaan kami jadi lebih tertib dan tepat waktu. Sangat direkomendasikan.'],
            ['client_name' => 'Siti Rahmawati', 'client_role' => 'Wajib Pajak Orang Pribadi', 'rating' => 5,
                'content' => 'Konsultasinya jelas dan mudah dipahami. Saya jadi lebih tenang mengurus kewajiban pajak tahunan. Terima kasih atas pendampingannya.'],
            ['client_name' => 'Andi Pratama', 'client_role' => 'Pemilik UMKM', 'rating' => 4,
                'content' => 'Dibantu memahami perencanaan pajak yang sesuai untuk usaha kecil. Solusinya praktis dan sesuai ketentuan.'],
            ['client_name' => 'Dewi Lestari', 'client_role' => 'Manajer Keuangan PT Sinar Abadi', 'rating' => 5,
                'content' => 'Pendampingan saat pemeriksaan pajak sangat membantu. Tim menjelaskan setiap tahapan dengan sabar dan detail.'],
        ];

        foreach ($items as $index => $item) {
            Testimonial::updateOrCreate(
                ['client_name' => $item['client_name']],
                [
                    'client_role' => $item['client_role'],
                    'content' => $item['content'],
                    'rating' => $item['rating'],
                    'is_active' => true,
                    'order' => $index + 1,
                ],
            );
        }
    }

    private function seedArticles(): void
    {
        $articles = [
            [
                'title' => 'Mengenal PPh: Pajak Penghasilan Secara Umum',
                'category' => 'pph',
                'excerpt' => 'Pengenalan ringkas mengenai Pajak Penghasilan (PPh), siapa yang dikenakan, dan mengapa penting untuk dipahami.',
                'content' => '<p>Pajak Penghasilan (PPh) adalah pajak yang dikenakan atas penghasilan yang diterima atau diperoleh Wajib Pajak, baik orang pribadi maupun badan. Memahami PPh membantu Anda mengelola kewajiban pajak secara lebih baik.</p><p>Artikel ini merupakan gambaran umum. Untuk penerapan sesuai kondisi Anda, silakan berkonsultasi dengan kami.</p>',
            ],
            [
                'title' => 'Dasar-Dasar PPN untuk Pelaku Usaha',
                'category' => 'ppn',
                'excerpt' => 'Apa itu PPN, siapa yang wajib memungut, dan hal-hal dasar yang perlu diketahui pelaku usaha.',
                'content' => '<p>Pajak Pertambahan Nilai (PPN) dikenakan atas konsumsi barang dan jasa kena pajak di dalam negeri. Bagi pelaku usaha, memahami mekanisme PPN penting untuk menjaga kepatuhan.</p><p>Ketentuan dapat berubah mengikuti peraturan terbaru. Konsultasikan kebutuhan spesifik usaha Anda bersama kami.</p>',
            ],
            [
                'title' => 'Tips Mempersiapkan Pelaporan SPT Tahunan',
                'category' => 'tips-pajak-umkm',
                'excerpt' => 'Langkah-langkah sederhana agar pelaporan SPT Tahunan berjalan lancar dan tepat waktu.',
                'content' => '<p>Persiapan yang baik membuat pelaporan SPT Tahunan lebih mudah. Mulai dari merapikan dokumen, mencatat penghasilan dan potongan pajak, hingga memastikan data sesuai.</p><p>Jika membutuhkan pendampingan, tim kami siap membantu menyusun dan melaporkan SPT Anda dengan akurat.</p>',
            ],
        ];

        foreach ($articles as $index => $item) {
            $categoryId = ArticleCategory::where('slug', $item['category'])->value('id');

            Article::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title' => $item['title'],
                    'excerpt' => $item['excerpt'],
                    'content' => $item['content'],
                    'article_category_id' => $categoryId,
                    'author_name' => 'Muhammad Yani',
                    'is_published' => true,
                    'published_at' => now()->subDays(($index + 1) * 3),
                ],
            );
        }
    }
}
