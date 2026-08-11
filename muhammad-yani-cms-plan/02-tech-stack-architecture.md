# Tech Stack & Arsitektur

## 1. Rekomendasi Stack

| Layer | Pilihan | Alasan |
|-------|---------|--------|
| Framework | **Laravel 12** | Standar, matang, ekosistem lengkap |
| Interaktivitas | **Livewire 3** | SPA-like tanpa build API terpisah, cocok untuk form kontak & filter dinamis |
| Admin Panel / CMS | **Filament v4** | Admin panel siap pakai, ringan, cepat dibangun, cocok untuk MVP dengan sedikit resource (Layanan, Izin, Pesan Masuk, Setting) |
| Role & Permission | **spatie/laravel-permission** + **Filament Shield** | Shield otomatis generate permission dari setiap Filament Resource, jadi 3 role (Superadmin, Admin, Editor) tinggal diatur lewat panel, tanpa tulis policy manual satu-satu |
| Styling Publik | **TailwindCSS v4** | Ringan (hanya CSS yang dipakai di-generate), mudah dibuat tema navy & gold custom sesuai brosur |
| Interaksi ringan | **Alpine.js** (built-in via Livewire) | Untuk animasi/toggle sederhana tanpa JS framework berat |
| Database | **MySQL** (produksi) / SQLite (lokal dev) | Standar hosting shared/Hostinger |
| Upload Gambar | **Spatie Media Library** | Kelola logo, foto profil, gambar layanan dengan rapi |
| SEO | **spatie/laravel-sitemap** + meta tag manual di Blade layout | Sitemap otomatis, meta OG/Twitter Card |
| Contact Form Anti-Spam | **Honeypot field + rate limiting** (tanpa reCAPTCHA dulu, opsional ditambah) | Ringan, tidak menambah beban render |
| Deployment | Hostinger + Cloudflare (mengikuti pola proyek sebelumnya) | Konsisten dengan infrastruktur yang sudah dikuasai |

> Catatan: Filament dipilih dibanding Tabler/Bootstrap manual (seperti pola proyek AKSI sebelumnya) karena untuk *company profile CMS sederhana* Filament jauh lebih cepat dibangun dan tetap ringan untuk admin-side. Sisi publik tetap 100% custom Blade + Tailwind agar desainnya bisa benar-benar menyerupai identitas visual brosur (bukan template generik).

## 2. Kenapa bukan stack lain?
- **Tanpa React/Vue/Inertia**: tidak perlu SPA kompleks untuk company profile 1 halaman + beberapa section. Livewire cukup dan lebih ringan untuk shared hosting.
- **Tanpa Vue Admin/Nova**: Filament open-source, gratis, komunitas besar, dan modelnya cocok untuk kebutuhan CRUD sederhana di sini.

## 3. Struktur Folder Kunci (Laravel)
```
app/
  Filament/
    Resources/
      ServiceResource.php
      LicenseResource.php
      ContactMessageResource.php
    Pages/
      Settings.php            <- single-record settings page (tagline, kontak, dsb)
  Livewire/
    ContactForm.php           <- komponen form konsultasi di halaman publik
  Models/
    Service.php
    License.php
    ContactMessage.php
    SiteSetting.php
resources/
  views/
    components/layouts/app.blade.php   <- layout publik
    livewire/contact-form.blade.php
    home.blade.php (atau dipecah per section: hero, services, licenses, about, contact)
  css/app.css                          <- tailwind + custom palette (navy #0B1E3D, gold #C9A24B)
database/
  migrations/
  seeders/
    ServiceSeeder.php   <- seed 6 layanan dari brosur
    LicenseSeeder.php   <- seed 3 izin dari brosur
    SiteSettingSeeder.php
```

## 4. Palet Desain (diambil dari brosur)
- **Navy tua**: `#0B1E3D` (background gelap, header, footer)
- **Navy sekunder**: `#132A4F`
- **Gold/emas**: `#C9A24B` (aksen, ikon, garis pemisah, hover state)
- **Putih/krem**: `#F8F6F1` (background section terang)
- **Tipografi**: heading serif elegan (mis. "Playfair Display" atau "Cormorant") untuk kesan hukum/formal, body sans-serif (mis. "Inter") untuk keterbacaan
- **Ikon**: line-icon bulat bergaya brosur (bisa pakai Heroicons/Lucide, di-style dengan lingkaran gold outline)

## 5. Catatan Teknis Deployment ke Hostinger

Karena website ini dipastikan berjalan di **Hostinger (shared hosting)** dengan Cloudflare, beberapa penyesuaian perlu disiapkan sejak awal supaya proses deploy nanti lancar:

1. **Versi PHP**: pastikan aktifkan PHP 8.2 atau 8.3 di panel Hostinger (hPanel) sebelum deploy — Laravel 12 butuh minimal PHP 8.2
2. **Document root**: domain/subdomain di Hostinger harus diarahkan ke folder `public/` milik Laravel, bukan ke root project. Kalau tidak bisa diarahkan langsung (tergantung paket hosting), gunakan trik symlink `public_html` -> isi folder `public/`, dengan file lain project diletakkan satu level di atas `public_html`
3. **SSL/Cloudflare**: mengacu pengalaman sebelumnya (subdomain `manajemen-feb.unm.ac.id`) yang sempat ada komplikasi SSL saat proxy mode aktif — pastikan set SSL/TLS mode di Cloudflare ke **"Full"** (bukan "Flexible") begitu sertifikat SSL aktif di Hostinger, untuk menghindari redirect loop
4. **Queue & Scheduler**: shared hosting Hostinger umumnya tidak mendukung queue worker (`php artisan queue:work`) berjalan terus-menerus. Untuk MVP, gunakan queue driver `database` atau `sync`, dan jika perlu scheduler (mis. kirim email newsletter terjadwal di fase lanjutan), jalankan `php artisan schedule:run` lewat **Cron Job** di hPanel setiap 1 menit
5. **Storage link**: setelah deploy, jalankan `php artisan storage:link` supaya file upload (logo, foto testimoni, gambar artikel, file unduhan via Spatie Media Library) bisa diakses publik
6. **.env produksi**: siapkan kredensial database MySQL dari hPanel, `APP_ENV=production`, `APP_DEBUG=false`, dan konfigurasi mail (SMTP) untuk notifikasi form kontak — bisa pakai SMTP Hostinger atau layanan lain (mis. Gmail SMTP untuk `muh.yani2013@gmail.com`)
7. **Deploy method**: karena Anda akan menyiapkan folder project sendiri, cara deploy paling praktis di shared hosting adalah upload lewat File Manager/FTP setelah build lokal (`composer install --no-dev`, `npm run build`), atau git pull manual jika Hostinger paket-nya mendukung SSH/Git deploy

## 7. Performa & "Ringan"
- Tailwind purge otomatis (hanya CSS terpakai)
- Gambar dioptimasi (WebP, lazy loading `loading="lazy"`)
- Tidak ada JS framework berat di sisi publik — hanya Alpine (~15kb) untuk toggle menu/animasi
- Cache halaman publik dengan `Cache::remember` untuk data layanan/izin (jarang berubah)
- Font di-load via `font-display: swap` agar tidak blocking render
