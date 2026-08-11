<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminPanelAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed penuh: role, permission (shield:generate di dalam ShieldRoleSeeder),
        // user superadmin, dan konten inti.
        $this->seed();
    }

    private function superadmin(): User
    {
        return User::where('email', 'muh.yani2013@gmail.com')->firstOrFail();
    }

    private function makeUserWithRole(string $role): User
    {
        $user = User::factory()->create();
        $user->assignRole(Role::findByName($role, 'web'));

        return $user;
    }

    public function test_role_dan_user_awal_terbentuk(): void
    {
        $this->assertEqualsCanonicalizing(
            ['superadmin', 'admin', 'editor'],
            Role::pluck('name')->all(),
        );

        $this->assertTrue($this->superadmin()->hasRole('superadmin'));
    }

    public function test_superadmin_bisa_membuka_semua_halaman_admin(): void
    {
        $this->actingAs($this->superadmin());

        foreach ([
            '/admin',
            '/admin/services',
            '/admin/services/create',
            '/admin/licenses',
            '/admin/licenses/create',
            '/admin/contact-messages',
            '/admin/manage-settings',
        ] as $url) {
            $this->get($url)->assertSuccessful();
        }
    }

    public function test_admin_bisa_konten_tapi_tidak_bisa_kelola_role(): void
    {
        $this->actingAs($this->makeUserWithRole('admin'));

        $this->get('/admin/services')->assertSuccessful();
        $this->get('/admin/licenses')->assertSuccessful();
        $this->get('/admin/manage-settings')->assertSuccessful();

        // Admin tidak boleh mengelola role/user.
        $this->get('/admin/shield/roles')->assertForbidden();
    }

    public function test_editor_hanya_lihat_pesan_tidak_bisa_services_dan_settings(): void
    {
        $this->actingAs($this->makeUserWithRole('editor'));

        $this->get('/admin/contact-messages')->assertSuccessful();

        // Editor tidak boleh akses data inti kantor & pengaturan.
        $this->get('/admin/services')->assertForbidden();
        $this->get('/admin/licenses')->assertForbidden();
        $this->get('/admin/manage-settings')->assertForbidden();
        $this->get('/admin/shield/roles')->assertForbidden();
    }

    public function test_user_tanpa_role_tidak_bisa_masuk_panel(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get('/admin')->assertForbidden();
    }
}
