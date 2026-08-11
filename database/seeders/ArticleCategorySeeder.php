<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Kategori artikel awal (contoh di 03-database-schema-features.md).
 * Bersifat struktural, bukan konten perpajakan, jadi aman di-seed langsung.
 * Artikel tidak di-seed karena belum ada konten (dibuat editor/admin).
 */
class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['PPh', 'PPN', 'Regulasi Terbaru', 'Tips Pajak UMKM'] as $name) {
            ArticleCategory::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name],
            );
        }
    }
}
