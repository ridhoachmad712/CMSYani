<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Role & akses (Fase 0/0B)
            RolesAndSuperAdminSeeder::class,
            ShieldRoleSeeder::class,

            // Konten inti dari brosur (Fase 1)
            ServiceSeeder::class,
            LicenseSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
