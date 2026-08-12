<?php

namespace App\Support;

use App\Models\SiteText;
use Illuminate\Support\Facades\Cache;

/**
 * Teks halaman depan yang dapat diubah dari panel admin.
 *
 * Sumber tunggal: definition() berisi grup -> field [label, default, multiline?].
 * Blade memakai helper site_text('key'); nilai diambil dari DB, jika kosong
 * jatuh ke default di sini. Dengan begitu situs tetap tampil walau belum diisi.
 */
class SiteTexts
{
    public const CACHE_KEY = 'site_texts';

    /**
     * @return array<string, array{label: string, fields: array<string, array{0:string,1:string,2?:bool}>}>
     */
    public static function definition(): array
    {
        return [
            'hero' => ['label' => 'Hero (Bagian Atas)', 'fields' => [
                'hero_badge' => ['Badge', 'Terdaftar & Berizin Resmi'],
                'hero_eyebrow' => ['Label Atas', 'Konsultan Pajak · Kuasa Hukum Pajak'],
                'hero_name' => ['Nama', 'Muhammad Yani'],
                'hero_gelar' => ['Gelar', 'S.E., Ak., M.Ak., M.H., CTR., CPAFS., BKP.'],
                'hero_cta_primary' => ['Teks Tombol Utama', 'Konsultasi Sekarang'],
                'hero_cta_whatsapp' => ['Teks Tombol WhatsApp', 'Chat WhatsApp'],
            ]],
            'izin' => ['label' => 'Izin & Kualifikasi', 'fields' => [
                'izin_eyebrow' => ['Label Atas', 'Legalitas Terpercaya'],
                'izin_title' => ['Judul', 'Izin & Kualifikasi'],
                'izin_subtitle' => ['Sub-judul', 'Legalitas dan kompetensi resmi yang menjadi dasar kepercayaan setiap layanan kami.', true],
            ]],
            'layanan' => ['label' => 'Layanan', 'fields' => [
                'layanan_eyebrow' => ['Label Atas', 'Apa yang Kami Tawarkan'],
                'layanan_title' => ['Judul', 'Layanan Kami'],
                'layanan_subtitle' => ['Sub-judul', 'Layanan profesional di bidang perpajakan dan hukum pajak untuk perusahaan, individu, maupun instansi.', true],
                'layanan_cta' => ['Teks Tombol', 'Lihat Semua Layanan'],
            ]],
            'tentang' => ['label' => 'Tentang Kami', 'fields' => [
                'tentang_eyebrow' => ['Label Atas', 'Mengenal Kami'],
                'tentang_title' => ['Judul', 'Tentang Kami'],
                'tentang_cta' => ['Teks Tombol', 'Selengkapnya Tentang Kami'],
            ]],
            'tim' => ['label' => 'Tim Kami', 'fields' => [
                'tim_eyebrow' => ['Label Atas', 'Profesional & Berpengalaman'],
                'tim_title' => ['Judul', 'Tim Konsultan & Rekan'],
                'tim_subtitle' => ['Sub-judul', 'KAP Muhammad Yani & Rekan didukung oleh para konsultan dan ahli hukum perpajakan yang siap mendampingi kepatuhan serta solusi hukum bisnis Anda.', true],
            ]],
            'nilai' => ['label' => 'Nilai Inti', 'fields' => [
                'nilai1_title' => ['Nilai 1 - Judul', 'Profesional'],
                'nilai1_desc' => ['Nilai 1 - Deskripsi', 'Layanan yang kompeten, terukur, dan sesuai ketentuan perpajakan.', true],
                'nilai2_title' => ['Nilai 2 - Judul', 'Integritas'],
                'nilai2_desc' => ['Nilai 2 - Deskripsi', 'Jujur, independen, dan menjunjung tinggi etika dalam setiap penanganan.', true],
                'nilai3_title' => ['Nilai 3 - Judul', 'Kepercayaan'],
                'nilai3_desc' => ['Nilai 3 - Deskripsi', 'Menjaga kerahasiaan dan membangun hubungan jangka panjang dengan klien.', true],
            ]],
            'testimoni' => ['label' => 'Testimoni', 'fields' => [
                'testimoni_eyebrow' => ['Label Atas', 'Testimoni'],
                'testimoni_title' => ['Judul', 'Apa Kata Klien'],
            ]],
            'artikel' => ['label' => 'Artikel Terbaru', 'fields' => [
                'artikel_title' => ['Judul', 'Artikel Terbaru'],
                'artikel_cta' => ['Teks Tautan', 'Lihat semua'],
            ]],
            'kontak' => ['label' => 'Kontak (Halaman Depan)', 'fields' => [
                'kontak_eyebrow' => ['Label Atas', 'Konsultasi'],
                'kontak_title' => ['Judul', 'Hubungi Kami'],
                'kontak_subtitle' => ['Sub-judul', 'Kunjungi kantor kami atau hubungi melalui kontak di bawah ini.', true],
            ]],
        ];
    }

    /** @return array<string,string> */
    public static function defaults(): array
    {
        $out = [];
        foreach (self::definition() as $group) {
            foreach ($group['fields'] as $key => $field) {
                $out[$key] = $field[1];
            }
        }

        return $out;
    }

    /** @return array<string,string> Nilai override dari DB (ter-cache). */
    public static function values(): array
    {
        return Cache::remember(self::CACHE_KEY, now()->addHours(6),
            fn () => SiteText::query()->pluck('value', 'key')->all());
    }

    public static function get(string $key): string
    {
        $value = self::values()[$key] ?? null;

        if ($value !== null && $value !== '') {
            return $value;
        }

        return self::defaults()[$key] ?? '';
    }

    public static function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
