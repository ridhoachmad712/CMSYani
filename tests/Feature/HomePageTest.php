<?php

namespace Tests\Feature;

use Database\Seeders\LicenseSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            SiteSettingSeeder::class,
            ServiceSeeder::class,
            LicenseSeeder::class,
        ]);
    }

    public function test_home_page_tampil_dengan_konten_brosur(): void
    {
        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertSee('Muhammad Yani');
        $response->assertSee('Solusi Tepat Kepatuhan Hemat');
        $response->assertSee('Layanan Kami');
        $response->assertSee('Konsultasi Pajak');
        $response->assertSee('Izin &amp; Kualifikasi', false);
        $response->assertSee('KP-1145/IP.A/2026');
        // Halaman depan: kontak menampilkan info + peta, TANPA form konsultasi
        $response->assertSee('Hubungi Kami');
        $response->assertDontSee('Form Konsultasi');
    }

    public function test_halaman_kontak_memiliki_form_konsultasi(): void
    {
        $this->get('/kontak')
            ->assertSuccessful()
            ->assertSee('Form Konsultasi');
    }

    public function test_hanya_layanan_aktif_yang_tampil(): void
    {
        \App\Models\Service::query()->where('slug', 'konsultasi-pajak')->update(['is_active' => false]);

        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertDontSee('Memberikan konsultasi perpajakan yang komprehensif');
        // Layanan lain tetap tampil
        $response->assertSee('Pendampingan Restitusi');
    }
}
