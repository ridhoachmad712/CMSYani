<?php

namespace Tests\Feature;

use Database\Seeders\LicenseSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MainPagesTest extends TestCase
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

    public function test_halaman_utama_sebagai_page_tersendiri_dapat_diakses(): void
    {
        $this->get('/layanan')->assertSuccessful()->assertSee('Layanan Kami');
        $this->get('/izin')->assertSuccessful()->assertSee('KP-1145/IP.A/2026');
        $this->get('/tentang')->assertSuccessful()->assertSee('Tentang Kami');
        $this->get('/kontak')->assertSuccessful()->assertSee('Form Konsultasi');
    }

    public function test_detail_layanan_tampil_dan_slug_tidak_aktif_404(): void
    {
        $this->get('/layanan/konsultasi-pajak')
            ->assertSuccessful()
            ->assertSee('Konsultasi Pajak')
            ->assertSee('Layanan Lainnya');

        $this->get('/layanan/tidak-ada')->assertNotFound();
    }

    public function test_navigasi_mengarah_ke_halaman_bukan_anchor(): void
    {
        $response = $this->get('/');

        $response->assertSee(route('services.index'), false);
        $response->assertSee(route('about'), false);
        $response->assertSee(route('contact'), false);
    }
}
