# Panduan Deployment — KAP Muhammad Yani (Hostinger + Cloudflare)

Panduan langkah demi langkah untuk men-deploy website ini ke **Hostinger (shared hosting)** dengan DNS/SSL via **Cloudflare**. Butuh akses hPanel Hostinger dan dashboard Cloudflare.

> Ringkas: build aset di lokal, upload project ke Hostinger, arahkan domain ke folder `public/`, isi `.env` produksi, jalankan migrate + storage:link, set SSL Full di Cloudflare, dan pasang cron.

---

## 1. Persiapan di Lokal (sebelum upload)

```bash
# Pastikan dependency produksi & aset ter-build
composer install --no-dev --optimize-autoloader
npm install
npm run build
```

Yang akan diupload: seluruh folder project **kecuali** `node_modules/` dan `.git/`. Sertakan `vendor/` dan `public/build/` hasil build (karena shared hosting sering tanpa composer/npm).

## 2. Setup di hPanel Hostinger

1. **PHP Version**: set ke **PHP 8.2 atau 8.3** (Laravel 12 minimal 8.2). Menu: hPanel → Advanced → PHP Configuration.
2. **Database MySQL**: buat database + user di hPanel → Databases → MySQL. Catat nama DB, username, password, host.
3. **Upload project**:
   - Opsi A (disarankan untuk keamanan): letakkan seluruh isi project **satu level di atas** `public_html`, lalu arahkan document root domain ke folder `public/` project (hPanel → Domains → ubah document root).
   - Opsi B (jika document root tidak bisa diubah): pindahkan isi folder `public/` ke `public_html`, taruh sisa project di folder lain (mis. `~/app`), lalu edit `public_html/index.php` agar path `require`-nya menunjuk ke lokasi `bootstrap/app.php` dan `vendor/autoload.php` yang benar.

## 3. Konfigurasi `.env` Produksi

Salin `.env.example` menjadi `.env`, lalu isi:

```
APP_NAME="KAP Muhammad Yani"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domainanda.com

APP_LOCALE=id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nama_db
DB_USERNAME=user_db
DB_PASSWORD=password_db

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=muh.yani2013@gmail.com
MAIL_PASSWORD="app-password-google"
MAIL_SCHEME=tls
MAIL_FROM_ADDRESS="muh.yani2013@gmail.com"
MAIL_FROM_NAME="KAP Muhammad Yani"
```

> Catatan mail: Gmail butuh **App Password** (bukan password akun biasa) — aktifkan 2FA lalu buat App Password di akun Google. Alternatif: SMTP bawaan Hostinger.

## 4. Perintah Setelah Upload (via SSH / Terminal hPanel)

```bash
php artisan key:generate        # jika APP_KEY masih kosong
php artisan migrate --force     # buat tabel di MySQL
php artisan db:seed --force     # OPSIONAL: role + konten awal (lihat catatan di bawah)
php artisan storage:link        # agar file upload (logo/foto/artikel) bisa diakses publik
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Catatan seeder produksi:**
- `DatabaseSeeder` memuat `DemoContentSeeder` (testimoni & artikel **contoh**). **Hapus** baris `DemoContentSeeder::class` di `database/seeders/DatabaseSeeder.php` sebelum seed produksi, atau hapus data demo lewat panel setelahnya.
- Konten FAQ/glosarium/kalender pajak berstatus/diaktifkan sebagai draft — **wajib direview Bapak Yani** sebelum diaktifkan ke publik.
- Ganti password superadmin default (`SuperAdmin#2026`) segera setelah login pertama.

## 5. SSL & Cloudflare

1. Aktifkan **SSL** di Hostinger (hPanel → Security → SSL) untuk domain.
2. Di **Cloudflare** → SSL/TLS → set mode ke **Full** (bukan Flexible) setelah sertifikat SSL aktif di Hostinger, untuk menghindari redirect loop.
3. Pastikan record DNS domain mengarah ke IP Hostinger (proxied/orange cloud sesuai kebutuhan).

## 6. Cron Job (Scheduler)

hPanel → Advanced → Cron Jobs, tambahkan (setiap 1 menit):

```
* * * * * cd /home/USERNAME/path-ke-project && php artisan schedule:run >> /dev/null 2>&1
```

Diperlukan untuk tugas terjadwal di masa depan (mis. broadcast newsletter). Sesuaikan path.

## 7. Uji Akhir (End-to-End)

- [ ] Buka domain (https) — landing page tampil, tanpa error, SSL hijau.
- [ ] `/admin` — login superadmin, ganti password.
- [ ] Upload **logo asli** & **foto profil** via Pengaturan Situs (cek tampil di frontend → `storage:link` sudah benar).
- [ ] Kirim **form kontak** di `/kontak` — cek data masuk di panel & email notifikasi diterima.
- [ ] Aktifkan konten FAQ/glosarium/kalender yang sudah direview.
- [ ] Cek tampilan **mobile**.
- [ ] Update **nomor izin** & **URL Instagram** sesuai data resmi.

## 8. Update Berikutnya (redeploy)

```bash
git pull                         # jika deploy via git
composer install --no-dev --optimize-autoloader
npm run build                    # atau upload folder public/build hasil build lokal
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

---

### Ringkasan yang butuh keputusan/aksi Bapak Yani
1. Nomor izin resmi (ada perbedaan gambar vs data tayang) — konfirmasi sebelum publish `/izin`.
2. Review & aktivasi konten pajak (FAQ/glosarium/kalender) yang masih draft.
3. Ganti/hapus konten demo (testimoni & artikel contoh).
4. URL Instagram asli, logo asli, foto profil.
5. Kredensial: DB MySQL, SMTP (App Password), dan ganti password superadmin.
