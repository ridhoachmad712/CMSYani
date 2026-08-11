<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndSuperAdminSeeder extends Seeder
{
    /**
     * Buat 3 role CMS (superadmin, admin, editor) dan 1 user superadmin awal.
     *
     * Idempotent: aman dijalankan berulang (firstOrCreate).
     * Assignment permission detail per role dilakukan di Fase 0B
     * setelah `php artisan shield:generate` menghasilkan permission dari Resource.
     * Role `superadmin` memiliki akses penuh via Gate::before milik Shield
     * (config filament-shield.super_admin.intercept_gate = 'before').
     */
    public function run(): void
    {
        // Bersihkan cache permission agar role baru langsung terbaca.
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $guard = 'web';

        foreach (['superadmin', 'admin', 'editor'] as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => $guard,
            ]);
        }

        // User superadmin awal (login Bapak Yani).
        // Password default sementara; WAJIB diganti setelah login pertama.
        $email = 'muh.yani2013@gmail.com';

        $superAdmin = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Muhammad Yani',
                'password' => Hash::make('SuperAdmin#2026'),
                'email_verified_at' => now(),
            ],
        );

        if (! $superAdmin->hasRole('superadmin')) {
            $superAdmin->assignRole('superadmin');
        }
    }
}
