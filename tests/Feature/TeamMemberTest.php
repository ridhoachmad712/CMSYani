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
}
