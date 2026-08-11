<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Assign permission ke 3 role sesuai matriks di
 * muhammad-yani-cms-plan/03-database-schema-features.md bagian C.
 *
 * Seeder ini AUTHORITATIVE dan IDEMPOTENT: memakai syncPermissions,
 * jadi state role selalu persis mengikuti matriks di sini.
 *
 * Nama permission Shield v4 berpola "Action:Subject" (mis. "Create:Article").
 * Karena pencocokan berbasis subjek, seeder aman dijalankan sekarang
 * (baru ada subjek Role) maupun setelah Fase 2 & 3B menambah Resource baru.
 * Alur: tambah Resource -> `php artisan shield:generate` -> jalankan seeder ini lagi.
 */
class ShieldRoleSeeder extends Seeder
{
    /** Subjek manajemen user/role: hanya superadmin. */
    private const USER_MANAGEMENT = ['Role', 'User'];

    /**
     * Subjek data inti kantor (superadmin + admin penuh, editor tidak boleh).
     * Catatan: Settings adalah custom Page (Fase 2), permission-nya bisa terpisah.
     */
    private const CORE = ['Service', 'License', 'SiteSetting', 'NewsletterSubscriber'];

    /** Subjek pesan masuk: editor hanya boleh lihat. */
    private const CONTACT = ['ContactMessage'];

    /** Subjek konten informatif: editor boleh create/update. */
    private const CONTENT = [
        'Testimonial',
        'Article',
        'ArticleCategory',
        'Faq',
        'TaxCalendarEvent',
        'GlossaryTerm',
        'Download',
    ];

    /** Aksi yang boleh dilakukan editor pada konten informatif (tanpa delete). */
    private const EDITOR_CONTENT_ACTIONS = ['ViewAny', 'View', 'Create', 'Update'];

    /** Aksi editor pada pesan masuk (lihat saja). */
    private const EDITOR_CONTACT_ACTIONS = ['ViewAny', 'View'];

    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $superadmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);

        $all = Permission::all();

        // Superadmin: seluruh permission (selain via Gate::before Shield,
        // diberikan eksplisit juga agar tidak bergantung pada satu mekanisme).
        $superadmin->syncPermissions($all);

        // Admin: semua permission KECUALI subjek manajemen user/role.
        $adminPerms = $all->reject(
            fn (Permission $p) => in_array($this->subjectOf($p->name), self::USER_MANAGEMENT, true)
        );
        $admin->syncPermissions($adminPerms);

        // Editor: hanya aksi tertentu pada konten informatif + lihat pesan masuk.
        $editorPerms = $all->filter(function (Permission $p) {
            $subject = $this->subjectOf($p->name);
            $action = $this->actionOf($p->name);

            if (in_array($subject, self::CONTENT, true)) {
                return in_array($action, self::EDITOR_CONTENT_ACTIONS, true);
            }

            if (in_array($subject, self::CONTACT, true)) {
                return in_array($action, self::EDITOR_CONTACT_ACTIONS, true);
            }

            return false;
        });
        $editor->syncPermissions($editorPerms);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /** Ambil bagian subjek dari nama permission "Action:Subject". */
    private function subjectOf(string $permissionName): string
    {
        return str_contains($permissionName, ':')
            ? explode(':', $permissionName, 2)[1]
            : $permissionName;
    }

    /** Ambil bagian aksi dari nama permission "Action:Subject". */
    private function actionOf(string $permissionName): string
    {
        return str_contains($permissionName, ':')
            ? explode(':', $permissionName, 2)[0]
            : $permissionName;
    }
}
