<?php

namespace Tests\Feature;

use App\Models\SiteText;
use App\Models\User;
use Database\Seeders\LicenseSeeder;
use Database\Seeders\RolesAndSuperAdminSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\ShieldRoleSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTextTest extends TestCase
{
    use RefreshDatabase;

    public function test_teks_default_tampil_lalu_dapat_diubah(): void
    {
        $this->seed([SiteSettingSeeder::class, ServiceSeeder::class, LicenseSeeder::class]);

        // Default
        $this->get('/')->assertSee('Layanan Kami');

        // Ubah teks
        SiteText::updateOrCreate(['key' => 'layanan_title'], ['value' => 'Bidang Layanan Kami']);

        $this->get('/')
            ->assertSee('Bidang Layanan Kami')
            ->assertDontSee('>Layanan Kami<', false);
    }

    public function test_halaman_teks_hanya_untuk_admin_bukan_editor(): void
    {
        $this->seed([RolesAndSuperAdminSeeder::class, ShieldRoleSeeder::class]);

        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin)->get('/admin/manage-texts')->assertSuccessful();

        $editor = User::factory()->create();
        $editor->assignRole('editor');
        $this->actingAs($editor)->get('/admin/manage-texts')->assertForbidden();
    }
}
