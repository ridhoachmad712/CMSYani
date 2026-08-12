<?php

namespace Tests\Feature;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TeamMemberTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\RolesAndSuperAdminSeeder::class);
        $this->seed(\Database\Seeders\ShieldRoleSeeder::class);
        $this->seed(\Database\Seeders\SiteSettingSeeder::class);
        $this->seed(\Database\Seeders\TeamMemberSeeder::class);
    }

    public function test_home_page_displays_active_team_members(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Tim Konsultan &amp; Rekan', false);
        $response->assertSee('Muhammad Yani, S.E., Ak., M.Ak., M.H., CTR., CPAFS., BKP.');
        $response->assertSee('Managing Partner / Konsultan Pajak Utama & Kuasa Hukum Pajak');
    }

    public function test_about_page_displays_team_members(): void
    {
        $response = $this->get('/tentang');

        $response->assertStatus(200);
        $response->assertSee('Tim Konsultan &amp; Rekan', false);
        $response->assertSee('Ahmad Hidayat, S.E., BKP.');
    }

    public function test_inactive_team_member_is_not_displayed_in_public(): void
    {
        TeamMember::create([
            'name' => 'Konsultan Nonaktif',
            'role' => 'Junior Consultant',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('Konsultan Nonaktif');
    }

    public function test_superadmin_can_access_team_members_admin_resource(): void
    {
        $user = User::factory()->create();
        $user->assignRole('superadmin');

        $response = $this->actingAs($user)->get('/admin/team-members');

        $response->assertStatus(200);
    }

    public function test_admin_tim_tetap_bisa_dibuka_walau_ada_anggota_tanpa_slug(): void
    {
        // Regresi: getRouteKeyName=slug membuat URL edit admin memakai slug.
        // Bila slug kosong, tabel admin gagal render. URL admin harus pakai id.
        TeamMember::create([
            'name' => 'Tanpa Slug Admin',
            'slug' => null,
            'role' => 'Konsultan',
            'is_active' => true,
        ]);

        $user = User::factory()->create();
        $user->assignRole('superadmin');

        $this->actingAs($user)->get('/admin/team-members')->assertSuccessful();
    }

    public function test_halaman_profil_anggota_tim_tampil(): void
    {
        $this->get('/tim/muhammad-yani')
            ->assertSuccessful()
            ->assertSee('Managing Partner', false)
            ->assertSee('memimpin KAP Muhammad Yani', false) // dari kolom detail (rich)
            ->assertSee('Anggota Tim Lainnya');
    }

    public function test_kartu_tim_menaut_ke_halaman_profil(): void
    {
        $this->get('/')->assertSee(route('team.show', 'muhammad-yani'), false);
    }

    public function test_profil_anggota_nonaktif_404(): void
    {
        TeamMember::create([
            'name' => 'Anggota Nonaktif',
            'slug' => 'anggota-nonaktif',
            'role' => 'Junior',
            'is_active' => false,
        ]);

        $this->get('/tim/anggota-nonaktif')->assertNotFound();
    }

    public function test_anggota_aktif_tanpa_slug_tidak_menjatuhkan_halaman(): void
    {
        // Data edge-case: anggota aktif dengan slug kosong tidak boleh membuat
        // route('team.show') error dan menjatuhkan seluruh halaman.
        TeamMember::create([
            'name' => 'Tanpa Slug',
            'slug' => null,
            'role' => 'Konsultan',
            'is_active' => true,
        ]);

        $this->get('/')->assertSuccessful();
        $this->get('/tentang')->assertSuccessful();
    }
}
