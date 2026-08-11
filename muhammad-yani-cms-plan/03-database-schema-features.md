# Skema Database & Daftar Fitur

## 1. Skema Database (MVP)

### `services` (Layanan Kami)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| title | string | Nama layanan |
| slug | string | Untuk anchor/SEO |
| description | text | Deskripsi singkat |
| icon | string | Nama ikon (heroicon/lucide key) |
| order | integer | Urutan tampil |
| is_active | boolean | Tampil/sembunyi |

### `licenses` (Izin & Kualifikasi)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| title | string | Nama izin, mis. "Izin Praktik Konsultan Pajak" |
| number | string | Nomor izin |
| icon | string | Ikon |
| order | integer | Urutan tampil |

### `site_settings` (single-record settings, key-value atau 1 row)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK (selalu 1 row) |
| tagline | string | "Solusi Tepat Kepatuhan Hemat" |
| hero_subtitle | text | Sub-judul hero |
| about_text | text | Paragraf Tentang Kami |
| quote_text | text | Kutipan nilai |
| email | string | |
| phone_primary | string | |
| phone_secondary | string | |
| address | text | |
| instagram_url | string | nullable |
| whatsapp_number | string | untuk floating WA button |
| logo_path | string | nullable, via media library — **jika kosong, tampilkan placeholder logo** (lihat bagian 1.1 di bawah) |

#### 1.1 Placeholder Logo
Karena file logo asli belum tersedia saat build awal, disiapkan mekanisme placeholder agar tampilan tetap rapi dari awal:
- Simpan file placeholder di `resources/images/logo-placeholder.svg` (bentuk sederhana: inisial "MY" dalam bingkai, warna navy & gold, meniru gaya logo di brosur — bukan logo asli, hanya penanda sementara)
- Di komponen header/footer, logic: `{{ $settings->logo_path ? asset('storage/'.$settings->logo_path) : asset('images/logo-placeholder.svg') }}`
- Di Filament `SettingsPage`, field upload logo diberi helper text: *"Upload logo resmi kantor. Jika belum diupload, sistem menampilkan placeholder sementara."*
- Ukuran/rasio placeholder disesuaikan dengan area logo di header (disarankan persegi atau sedikit landscape, mis. 200x80px) supaya saat logo asli diupload nanti, tidak perlu ubah layout

### `contact_messages` (pesan masuk dari form konsultasi)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| name | string | |
| email | string | |
| phone | string | nullable |
| subject | string | nullable, mis. "Konsultasi Pajak" |
| message | text | |
| is_read | boolean | default false |
| created_at | timestamp | |

### `users` (Pengguna CMS)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| name | string | |
| email | string | unique |
| password | string | hashed |
| role | via `spatie/laravel-permission` (tabel pivot `model_has_roles`) | 3 role: `superadmin`, `admin`, `editor` — lihat matriks di bagian C |

> Tabel role/permission detail (`roles`, `permissions`, `model_has_roles`, `role_has_permissions`) otomatis dibuat oleh package `spatie/laravel-permission`, tidak perlu dirancang manual.

### `testimonials` (Testimoni Klien)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| client_name | string | |
| client_role | string | nullable, mis. "Direktur PT ABC" atau "Wajib Pajak Orang Pribadi" |
| content | text | isi testimoni |
| rating | tinyint | nullable, 1-5 |
| photo | string | nullable, via media library |
| is_active | boolean | tampil/sembunyi |
| order | integer | urutan tampil |

### `article_categories` (Kategori Artikel Pajak)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| name | string | mis. "PPh", "PPN", "Regulasi Terbaru", "Tips Pajak UMKM" |
| slug | string | |

### `articles` (Blog/Artikel Pajak)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| title | string | |
| slug | string | unique |
| excerpt | text | ringkasan untuk kartu preview |
| content | longtext | isi artikel (rich text via Filament RichEditor) |
| featured_image | string | nullable, via media library |
| article_category_id | bigint | FK ke `article_categories` |
| author_name | string | default nama Yani, bisa diubah |
| is_published | boolean | |
| published_at | timestamp | nullable, untuk jadwal terbit |
| meta_title | string | nullable, SEO |
| meta_description | string | nullable, SEO |
| views_count | integer | default 0, opsional untuk lihat artikel populer |

### `faqs` (FAQ Pajak)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| question | string | |
| answer | text | |
| category | string | nullable, mis. "Umum", "SPT", "Konsultasi" |
| order | integer | |
| is_active | boolean | |

### `tax_calendar_events` (Kalender Pajak — jatuh tempo)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| title | string | mis. "Jatuh Tempo Lapor SPT Masa PPN" |
| description | text | nullable |
| category | string | mis. "SPT Masa", "SPT Tahunan", "Pembayaran" |
| due_rule | string | aturan jatuh tempo, mis. "Setiap tanggal 20 bulan berikutnya" (teks bebas, bukan tanggal absolut karena sifatnya berulang tiap tahun) |
| is_active | boolean | |

> Catatan: kalender pajak dibuat berbasis aturan berulang (teks deskriptif), bukan tanggal pasti per tahun, supaya admin tidak perlu update setahun sekali. Jika ingin ada pengingat otomatis per tanggal spesifik, bisa dikembangkan lebih lanjut di fase berikutnya (mis. tambah kolom `next_due_date` yang dihitung otomatis).

### `glossary_terms` (Glosarium Istilah Pajak)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| term | string | mis. "PTKP", "Bukti Potong", "Restitusi" |
| slug | string | |
| definition | text | |
| category | string | nullable |
| order | integer | |

### `downloads` (Pusat Unduhan)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| title | string | mis. "Formulir SPT Tahunan 1770" |
| description | text | nullable |
| file | string | via media library, PDF/DOCX |
| category | string | mis. "Formulir", "Panduan", "Peraturan" |
| download_count | integer | default 0 |
| is_active | boolean | |

### `newsletter_subscribers` (Berlangganan Info Pajak — opsional/ringan)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | PK |
| email | string | unique |
| subscribed_at | timestamp | |
| is_active | boolean | untuk unsubscribe |

## 2. Daftar Fitur

### A. Halaman Publik (mengikuti struktur brosur 1:1)
1. **Hero Section** — nama, gelar, tagline, sub-judul, CTA "Konsultasi Sekarang" (scroll ke form/WA)
2. **Layanan Kami** — grid 6 layanan dengan ikon (dari tabel `services`)
3. **Izin & Kualifikasi** — 3 kartu izin + nomor (dari tabel `licenses`)
4. **Tentang Kami** — paragraf profil kantor
5. **Kutipan Nilai** — highlight quote "Integritas, Profesionalisme, dan Kerahasiaan..."
6. **Nilai Inti** — 3 badge: Profesional, Integritas, Kepercayaan
7. **Kontak & Form Konsultasi** — alamat, telepon, email, peta (embed Google Maps), form Livewire
8. **Floating WhatsApp Button** — muncul di semua halaman
9. **Footer** — ringkasan kontak, copyright, link Instagram

### A2. Halaman Publik — Modul Konten Edukasi Pajak (tambahan)
7. **Testimoni Klien** — section carousel/grid di landing page, menampilkan `testimonials` aktif
8. **Blog/Artikel Pajak** — `/artikel` (listing + filter kategori + search + pagination), `/artikel/{slug}` (detail + artikel terkait), section "Artikel Terbaru" di landing page
9. **FAQ Pajak** — section akordeon di landing page atau halaman `/faq` tersendiri, bisa difilter per kategori
10. **Kalender Pajak** — halaman `/kalender-pajak` menampilkan daftar jatuh tempo lapor/bayar pajak per kategori (SPT Masa, SPT Tahunan, dsb), disusun rapi per bulan
11. **Glosarium Istilah Pajak** — halaman `/glosarium`, daftar alfabetis + pencarian istilah
12. **Pusat Unduhan** — halaman `/unduhan`, daftar formulir/panduan yang bisa didownload, dikelompokkan per kategori, hitung jumlah download
13. **Newsletter** — form input email kecil di footer/blog, menyimpan ke `newsletter_subscribers` (pengiriman email broadcast bisa manual dulu, integrasi otomatis di fase lanjutan)

### B. Admin Panel (Filament)
1. **Dashboard** — jumlah pesan baru, artikel terbit, statistik sederhana
2. **Kelola Layanan** — CRUD tabel `services`, drag-reorder
3. **Kelola Izin & Kualifikasi** — CRUD tabel `licenses`, drag-reorder
4. **Kelola Pengaturan Situs** — form single-record untuk `site_settings` (tagline, kontak, about, logo upload)
5. **Pesan Masuk** — list `contact_messages`, tandai sudah dibaca, hapus, filter belum dibaca
6. **Kelola Testimoni** — CRUD `testimonials`, upload foto klien, drag-reorder
7. **Kelola Artikel & Kategori** — CRUD `articles` (rich text editor, upload gambar, jadwal terbit) + CRUD `article_categories`
8. **Kelola FAQ** — CRUD `faqs`, drag-reorder, filter kategori
9. **Kelola Kalender Pajak** — CRUD `tax_calendar_events`
10. **Kelola Glosarium** — CRUD `glossary_terms`
11. **Kelola Unduhan** — CRUD `downloads` dengan upload file, lihat jumlah download
12. **Daftar Subscriber Newsletter** — list `newsletter_subscribers`, export ke CSV untuk kirim manual
13. **User Management** — kelola user CMS dengan 3 role (lihat matriks di bawah)

## C. Role & Permission (3 Level)

Menggunakan **spatie/laravel-permission** + **Filament Shield** (plugin yang otomatis generate permission dari setiap Filament Resource, cocok dipasang di atas stack Filament yang sudah dipilih).

| Modul / Aksi | Superadmin | Admin | Editor |
|---|---|---|---|
| Kelola Layanan (Services) | ✅ Full | ✅ Full | ❌ Tidak bisa |
| Kelola Izin & Kualifikasi (Licenses) | ✅ Full | ✅ Full | ❌ Tidak bisa |
| Pengaturan Situs (Settings, termasuk upload logo) | ✅ Full | ✅ Full | ❌ Tidak bisa |
| Pesan Masuk (Contact Messages) | ✅ Full | ✅ Full | 👁️ Lihat saja |
| Testimoni Klien | ✅ Full | ✅ Full | ✅ Create/Update (tidak bisa hapus) |
| Artikel & Kategori Artikel | ✅ Full | ✅ Full | ✅ Create/Update/**Publish langsung** (tanpa approval) |
| FAQ Pajak | ✅ Full | ✅ Full | ✅ Create/Update |
| Kalender Pajak | ✅ Full | ✅ Full | ✅ Create/Update |
| Glosarium Istilah Pajak | ✅ Full | ✅ Full | ✅ Create/Update |
| Pusat Unduhan | ✅ Full | ✅ Full | ✅ Create/Update |
| Newsletter Subscriber (lihat/export) | ✅ Full | ✅ Full | ❌ Tidak bisa |
| User Management (tambah/hapus user, atur role) | ✅ Full | ❌ Tidak bisa | ❌ Tidak bisa |
| Hapus data (delete) di semua modul konten | ✅ Full | ✅ Full | ❌ Tidak bisa (hanya create/update) |

**Ringkasan definisi role:**
- **Superadmin**: kontrol penuh atas seluruh sistem, termasuk manajemen user/role — biasanya dipegang oleh Bapak Yani atau developer/IT
- **Admin**: kontrol penuh atas seluruh konten dan operasional situs (termasuk data inti seperti Layanan, Izin, Settings), tapi tidak bisa mengelola user lain
- **Editor**: hanya bisa membuat dan memperbarui konten informatif (artikel, FAQ, glosarium, kalender pajak, unduhan, testimoni) — tidak bisa menghapus data maupun menyentuh data inti kantor (layanan, izin, settings, user)

### C. Non-Fungsional
- Responsive penuh (mobile-first, mengikuti pola brosur 3-kolom yang perlu di-adapt ke mobile 1-kolom)
- Waktu load halaman utama target < 2 detik di koneksi 4G rata-rata
- Aksesibilitas dasar (alt text gambar, kontras warna cukup — gold di atas navy perlu dites kontrasnya)
- Keamanan: rate limit form kontak, honeypot anti-bot, validasi server-side penuh
- Backup: rekomendasi backup database berkala (bisa manual atau cron sederhana)

## 3. Skema Navigasi (Sitemap)
Dengan penambahan modul konten edukasi, situs bergeser dari murni one-page menjadi **one-page utama + beberapa halaman konten mandiri** (karena artikel, kalender pajak, glosarium, dan unduhan butuh URL sendiri agar mudah dibagikan dan bagus untuk SEO).

```
/                       -> Landing page (hero, layanan, izin, tentang kami, testimoni, artikel terbaru, kontak)
  #layanan
  #izin-kualifikasi
  #tentang-kami
  #testimoni
  #kontak
/artikel                -> Listing blog/artikel pajak (filter kategori, search, pagination)
/artikel/{slug}         -> Detail artikel + artikel terkait
/faq                    -> Halaman FAQ pajak (akordeon, filter kategori)
/kalender-pajak         -> Daftar jatuh tempo lapor/bayar pajak per kategori
/glosarium              -> Daftar istilah pajak (alfabetis + pencarian)
/unduhan                -> Pusat unduhan formulir/panduan pajak
/admin                  -> Filament panel (login required)
```

Navigasi header publik disarankan: **Beranda | Layanan | Artikel | FAQ | Kalender Pajak | Glosarium | Unduhan | Kontak** — bisa disederhanakan jadi dropdown "Info Pajak" (menaungi Artikel, FAQ, Kalender Pajak, Glosarium, Unduhan) agar header tetap ringkas dan tidak terlalu panjang.
