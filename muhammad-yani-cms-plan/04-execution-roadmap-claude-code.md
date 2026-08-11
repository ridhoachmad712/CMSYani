# Roadmap Eksekusi di Claude Code

Rancangan ini dipecah menjadi fase-fase kecil agar Claude Code bisa mengeksekusi bertahap, sesuai pola kerja yang biasa dipakai (plan-before-execution).

## Fase 0 — Setup Proyek
> Catatan: jalankan seluruh langkah ini **di dalam folder project yang sudah Anda siapkan sendiri** — Claude Code tidak perlu membuat folder baru di root, cukup diarahkan ke folder tersebut.

- [ ] `laravel new .` (di dalam folder project yang sudah dibuat) — atau `composer create-project laravel/laravel .` jika folder sudah ada isinya (mis. sudah ada folder plan)
- [ ] Install Livewire 3: `composer require livewire/livewire`
- [ ] Install Filament v4: `composer require filament/filament` lalu `php artisan filament:install --panels`
- [ ] Install Filament Shield (role & permission): `composer require bezhansalleh/filament-shield` lalu `php artisan shield:install`
- [ ] Install Spatie Media Library: `composer require spatie/laravel-medialibrary`
- [ ] Install Spatie Sitemap: `composer require spatie/laravel-sitemap`
- [ ] Setup TailwindCSS v4 + konfigurasi palet warna custom (navy `#0B1E3D`, gold `#C9A24B`)
- [ ] Setup font (Playfair Display / Cormorant untuk heading, Inter untuk body) via Google Fonts atau self-hosted
- [ ] Siapkan file placeholder logo di `resources/images/logo-placeholder.svg` (lihat detail di `03-database-schema-features.md` bagian 1.1)
- [ ] Init git repository, commit awal
- [ ] Buat 3 role via Shield: `superadmin`, `admin`, `editor`, lalu buat 1 user awal dengan role `superadmin` (email login Bapak Yani) via seeder/tinker

**Prompt contoh untuk Claude Code:**
> "Di dalam folder project ini, setup Laravel 12, install Livewire 3, Filament v4 dengan panel default di /admin, Filament Shield untuk role & permission (superadmin, admin, editor), Spatie Media Library, dan Spatie Sitemap. Konfigurasi TailwindCSS v4 dengan warna custom navy #0B1E3D dan gold #C9A24B. Siapkan file placeholder logo di resources/images/logo-placeholder.svg dengan bentuk inisial 'MY' bergaya navy & gold."

## Fase 0B — Setup Role & Permission (Filament Shield)
- [ ] Jalankan `php artisan shield:generate` untuk auto-generate permission dari semua Filament Resource yang sudah dibuat (dijalankan ulang setiap kali ada Resource baru di Fase 2 & 3B)
- [ ] Assign permission ke role sesuai matriks di `03-database-schema-features.md` bagian C:
  - `superadmin`: semua permission (termasuk manage users)
  - `admin`: semua permission konten + delete, tanpa manage users
  - `editor`: hanya create + update untuk Testimoni, Artikel, FAQ, Kalender Pajak, Glosarium, Unduhan (tanpa delete, tanpa akses Services/Licenses/Settings/User Management)
- [ ] Uji login dengan masing-masing role, pastikan menu & aksi yang tampil sesuai hak akses

## Fase 1 — Database, Model, Seeder
- [ ] Migration untuk `services`, `licenses`, `site_settings`, `contact_messages`
- [ ] Model + relasi (jika ada) + `$casts`, `$fillable`
- [ ] Seeder berisi data asli dari brosur (lihat file `01-project-brief.md` bagian 5.3 dan 5.4)
- [ ] Jalankan `php artisan migrate --seed`

**Catatan penting untuk seeder**: gunakan data yang sudah diekstrak di `01-project-brief.md` — jangan mengarang ulang teks layanan/izin, salin persis agar konsisten dengan brosur resmi.

## Fase 2 — Admin Panel (Filament Resources)
- [ ] `ServiceResource` — form (title, slug auto, description, icon picker/select, order, is_active), table dengan reorder
- [ ] `LicenseResource` — form (title, number, icon, order)
- [ ] `ContactMessageResource` — read-only-ish (view + mark as read + delete), badge jumlah belum dibaca di navigasi
- [ ] `SettingsPage` custom (bukan resource biasa, karena single record) untuk site_settings + upload logo
- [ ] Uji semua CRUD berjalan dan tervalidasi

## Fase 3 — Frontend Publik
- [ ] Layout dasar `components/layouts/app.blade.php` (header sticky, footer, meta tag, floating WA button)
- [ ] Section Hero — ambil data dari `site_settings`
- [ ] Section Layanan Kami — grid responsif dari `services` (urut berdasarkan `order`)
- [ ] Section Izin & Kualifikasi — kartu dari `licenses`
- [ ] Section Tentang Kami + Kutipan Nilai
- [ ] Section Nilai Inti (Profesional, Integritas, Kepercayaan) — bisa statis atau dari settings
- [ ] Section Kontak — info kontak dari settings + embed Google Maps (alamat: Jl. Muhajirin No. 7 Bangkala Manggala, Makassar) + komponen Livewire `ContactForm`
- [ ] Livewire `ContactForm`: validasi, honeypot, simpan ke `contact_messages`, kirim notifikasi email ke admin (`Mail::to(...)`), tampilkan pesan sukses
- [ ] Footer

## Fase 3B — Modul Konten Edukasi Pajak
- [ ] Migration untuk `testimonials`, `article_categories`, `articles`, `faqs`, `tax_calendar_events`, `glossary_terms`, `downloads`, `newsletter_subscribers`
- [ ] Model + Filament Resource untuk masing-masing (RichEditor untuk `articles.content`, drag-reorder untuk yang butuh `order`)
- [ ] Seeder awal: gunakan data placeholder yang sudah disiapkan di `05-placeholder-content-pajak.md` (FAQ, glosarium, kalender pajak). Set status non-aktif/draft dulu — **wajib direview dan diaktifkan manual oleh Bapak Yani** sebelum tayang ke publik, karena menyangkut informasi resmi perpajakan
- [ ] Halaman publik: `/artikel`, `/artikel/{slug}`, `/faq`, `/kalender-pajak`, `/glosarium`, `/unduhan`
- [ ] Section testimoni + artikel terbaru di landing page (`/`)
- [ ] Form newsletter sederhana (simpan email, tanpa integrasi email marketing dulu)
- [ ] Update navigasi header (dropdown "Info Pajak" menaungi Artikel/FAQ/Kalender/Glosarium/Unduhan)
- [ ] Update sitemap.xml agar mencakup semua halaman baru

**Catatan penting**: konten kalender pajak, FAQ, dan glosarium menyangkut informasi resmi perpajakan. Sebelum publish ke publik, isi kontennya wajib direview/diverifikasi oleh Bapak Yani sendiri (bukan hanya hasil generate AI) agar tidak menyesatkan calon klien.

## Fase 4 — Polishing Desain & Animasi
- [ ] Terapkan palet navy & gold konsisten di semua section (samakan dengan feel brosur)
- [ ] Animasi ringan Alpine.js (fade-in on scroll, hover state ikon)
- [ ] Uji responsive di breakpoint mobile/tablet/desktop
- [ ] Optimasi gambar (convert ke WebP, tambahkan `loading="lazy"`)
- [ ] Cek kontras warna teks gold di atas navy (aksesibilitas)

## Fase 5 — SEO, Keamanan, & Deployment ke Hostinger
- [ ] Meta tags (title, description, OG image) berbasis data `site_settings`
- [ ] Schema.org markup `LocalBusiness`/`ProfessionalService` + `Person` untuk Muhammad Yani
- [ ] Generate sitemap.xml otomatis
- [ ] Rate limiting form kontak (`throttle` middleware)
- [ ] `.env.example` lengkap
- [ ] Set PHP 8.2/8.3 di hPanel Hostinger, arahkan document root ke folder `public/`
- [ ] Setup SSL di Hostinger, set Cloudflare SSL/TLS mode ke **"Full"** (bukan Flexible) untuk hindari redirect loop
- [ ] Setup Cron Job di hPanel untuk `php artisan schedule:run` setiap 1 menit (untuk kebutuhan terjadwal di masa depan, mis. newsletter)
- [ ] Setelah upload/deploy: jalankan `php artisan storage:link`, `php artisan migrate --force`, `php artisan config:cache`
- [ ] Uji akhir end-to-end (form kontak, admin CRUD per role, upload logo asli menggantikan placeholder, tampilan mobile)

---

## Draft `CLAUDE.md` (konvensi proyek — taruh di root repo sebelum mulai)

```markdown
# CLAUDE.md — Konvensi Proyek KAP Muhammad Yani

## Stack
Laravel 12, Livewire 3, Filament v4 (admin panel di /admin), Filament Shield untuk role & permission, TailwindCSS v4, Alpine.js, MySQL (produksi di Hostinger) / SQLite (lokal dev).

## Role & Permission
3 role: superadmin (full access + user management), admin (full akses konten, tanpa user management), editor (hanya create/update konten informatif: artikel, FAQ, kalender pajak, glosarium, unduhan, testimoni — tidak bisa delete, tidak bisa akses Services/Licenses/Settings). Detail matriks di 03-database-schema-features.md bagian C. Setiap kali menambah Filament Resource baru, jalankan ulang `php artisan shield:generate` dan update assignment permission sesuai matriks.

## Prinsip Kerja
- Selalu eksekusi per fase sesuai roadmap di 04-execution-roadmap-claude-code.md
- Konfirmasi hasil setiap fase sebelum lanjut ke fase berikutnya
- Data konten (layanan, izin, kontak) HARUS sesuai isi 01-project-brief.md, jangan mengarang teks baru
- Konten kalender pajak, FAQ, dan glosarium wajib ditandai sebagai draft/butuh review sebelum dianggap final — jangan publish otomatis tanpa konfirmasi
- Logo: gunakan placeholder di resources/images/logo-placeholder.svg sampai file logo asli diupload lewat panel Settings

## Konvensi Kode
- Penamaan: PascalCase untuk class, camelCase untuk method/variable, kebab-case untuk route/slug
- Tidak menggunakan tanda hubung panjang (em dash) di teks/komentar/konten
- Semua teks tampil ke publik dalam Bahasa Indonesia baku
- Blade component untuk setiap section landing page (hero, services, licenses, about, contact) agar mudah dipelihara

## Desain
- Warna: navy #0B1E3D (primary), gold #C9A24B (accent), putih/krem #F8F6F1 (background terang)
- Heading font: Playfair Display / Cormorant, Body font: Inter
- Mobile-first, ringan (minim JS, Tailwind purge aktif)

## Testing
- Setiap fitur CRUD di Filament diuji manual: create, edit, delete, reorder
- Form kontak diuji: validasi gagal & sukses, email terkirim, data tersimpan
```

---

## Cara Pakai Dokumen Ini di Claude Code
1. Salin folder `muhammad-yani-cms-plan/` ke root repo baru
2. Simpan draft `CLAUDE.md` di atas sebagai file `CLAUDE.md` di root project
3. Jalankan fase satu per satu dengan prompt yang mengacu ke file rancangan ini (mis. "Jalankan Fase 0 sesuai 04-execution-roadmap-claude-code.md")
4. Setelah setiap fase, minta Claude Code menjalankan `php artisan test` (jika ada test) atau cek manual sebelum lanjut
