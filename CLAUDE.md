# CLAUDE.md — Konvensi Proyek KAP Muhammad Yani

## Stack
Laravel 12, Livewire 3, Filament v4 (admin panel di /admin), Filament Shield untuk role & permission, TailwindCSS v4, Alpine.js, MySQL (produksi di Hostinger) / SQLite (lokal dev).

## Role & Permission
3 role: superadmin (full access + user management), admin (full akses konten, tanpa user management), editor (hanya create/update konten informatif: artikel, FAQ, kalender pajak, glosarium, unduhan, testimoni — tidak bisa delete, tidak bisa akses Services/Licenses/Settings). Editor dapat publish artikel langsung tanpa approval Admin. Detail matriks di 03-database-schema-features.md bagian C. Setiap kali menambah Filament Resource baru, jalankan ulang `php artisan shield:generate` dan update assignment permission sesuai matriks.

## Prinsip Kerja
- Selalu eksekusi per fase sesuai roadmap di 04-execution-roadmap-claude-code.md
- Konfirmasi hasil setiap fase sebelum lanjut ke fase berikutnya
- Data konten (layanan, izin, kontak) HARUS sesuai isi 01-project-brief.md, jangan mengarang teks baru
- Konten kalender pajak, FAQ, dan glosarium menggunakan draft di 05-placeholder-content-pajak.md, disimpan dengan status non-aktif/draft, wajib direview dan diaktifkan manual oleh Bapak Yani sebelum tayang ke publik
- Logo: gunakan placeholder di resources/images/logo-placeholder.svg sampai file logo asli diupload lewat panel Settings

## Konvensi Kode
- Penamaan: PascalCase untuk class, camelCase untuk method/variable, kebab-case untuk route/slug
- Tidak menggunakan tanda hubung panjang (em dash) di teks/komentar/konten
- Semua teks tampil ke publik dalam Bahasa Indonesia baku
- Blade component untuk setiap section landing page (hero, services, licenses, about, testimonials, contact) agar mudah dipelihara

## Desain
- Warna: navy #0B1E3D (primary), gold #C9A24B (accent), putih/krem #F8F6F1 (background terang)
- Heading font: Playfair Display / Cormorant, Body font: Inter
- Mobile-first, ringan (minim JS, Tailwind purge aktif)

## Hosting
Deploy target: Hostinger (shared hosting) dengan Cloudflare untuk DNS/SSL. Lihat 02-tech-stack-architecture.md bagian Catatan Teknis Deployment ke Hostinger untuk detail (PHP version, document root, SSL mode, cron job, dll).

## Testing
- Setiap fitur CRUD di Filament diuji manual per role: create, edit, delete (khusus superadmin/admin), reorder
- Form kontak diuji: validasi gagal & sukses, email terkirim, data tersimpan
- Uji akses per role: pastikan editor tidak bisa akses Services/Licenses/Settings/User Management
