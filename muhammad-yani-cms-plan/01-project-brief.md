# Project Brief — Website CMS Kantor Konsultan Pajak Muhammad Yani

## 1. Nama Proyek
**KAP Muhammad Yani — Website Profil & CMS**
(Kantor Konsultan Pajak dan Kuasa Hukum Pajak)

## 2. Latar Belakang
Muhammad Yani, S.E., Ak., M.Ak., M.H., CTR., CPAFS., BKP. adalah Konsultan Pajak dan Kuasa Hukum Pajak yang saat ini mempromosikan jasanya melalui brosur cetak/digital. Website ini dibutuhkan untuk:
- Membangun kredibilitas dan kehadiran digital yang profesional
- Memudahkan calon klien menemukan layanan, izin praktik, dan kontak
- Menjadi kanal utama untuk konsultasi awal (form kontak, WhatsApp, email)
- Dikelola mandiri melalui CMS (admin panel) tanpa perlu edit kode setiap ada perubahan konten

## 3. Tujuan Utama
1. Website company profile yang ringan, cepat, dan menarik secara visual (tema navy & gold, konsisten dengan identitas brosur)
2. Admin panel (CMS) sederhana untuk mengelola: layanan, izin & kualifikasi, info kontak, dan pesan masuk dari calon klien
3. Mobile-friendly, SEO-friendly (agar mudah ditemukan saat orang mencari "konsultan pajak Makassar", dsb)
4. Skalabel — mudah ditambah modul lain di masa depan (blog/artikel pajak, testimoni klien, dsb)

## 4. Target Pengguna
- **Publik/calon klien**: individu, UMKM, atau perusahaan yang butuh jasa konsultasi/kepatuhan pajak
- **Admin (Bapak Muhammad Yani / staf)**: mengelola konten dan memantau pesan masuk dari website

## 5. Profil & Data Konten (diekstrak dari brosur)

### 5.1 Identitas
- **Nama**: Muhammad Yani, S.E., Ak., M.Ak., M.H., CTR., CPAFS., BKP.
- **Jabatan/Peran**: Konsultan Pajak - Kuasa Hukum Pajak
- **Tagline**: "Solusi Tepat Kepatuhan Hemat"
- **Sub-tagline hero**: "Solusi Profesional untuk Kepatuhan Pajak dan Perlindungan Hukum Bisnis Anda"
- **Kutipan nilai**: "Integritas, Profesionalisme, dan Kerahasiaan adalah komitmen kami dalam setiap layanan."

### 5.2 Tentang Kami
> Kantor Konsultan Pajak dan Kuasa Hukum Pajak Muhammad Yani hadir untuk memberikan layanan profesional, independen, dan terpercaya di bidang perpajakan dan hukum pajak bagi perusahaan, individu, maupun instansi.
>
> Kami berkomitmen menjadi mitra strategis dalam mendukung kepatuhan pajak dan melindungi hak hukum klien secara optimal.

### 5.3 Layanan Kami (6 layanan)
| # | Layanan | Deskripsi |
|---|---------|-----------|
| 1 | Konsultasi Pajak | Memberikan konsultasi perpajakan yang komprehensif dan solusi atas permasalahan perpajakan perusahaan Anda. |
| 2 | Tax Review & Tax Planning | Review kepatuhan pajak dan perencanaan pajak (tax planning) yang efektif, efisien, dan sesuai ketentuan. |
| 3 | Penyusunan & Pelaporan SPT | Menyusun dan melaporkan SPT Masa maupun Tahunan dengan akurat dan tepat waktu. |
| 4 | Pendampingan Pemeriksaan | Pendampingan dalam pemeriksaan pajak, klarifikasi data, hingga penyelesaian administrasi perpajakan. |
| 5 | Keberatan, Banding & Gugatan | Mewakili dan mendampingi Wajib Pajak dalam proses keberatan, banding, hingga gugatan di Pengadilan Pajak. |
| 6 | Pendampingan Restitusi | Bantuan pengajuan restitusi pajak lebih bayar dan percepatan proses pengembaliannya. |

### 5.4 Izin & Kualifikasi (3 izin)
| Izin | Nomor |
|------|-------|
| Izin Praktik Konsultan Pajak | KP-1145/IP.A/2026 |
| Izin Kuasa Hukum Pajak | KEP-595/IKH/2024 |
| Izin Kuasa Kepabeanan dan Cukai | KEP-1100/PP/IKH/2024 |

### 5.5 Nilai Inti / Value Proposition (ikon footer brosur)
- Profesional
- Integritas
- Kepercayaan

### 5.6 Kontak
- **Email**: muh.yani2013@gmail.com
- **Telepon/WA**: 0853 4224 1563 / 0813 8486 6511
- **Alamat**: Jl. Muhajirin No. 7 Bangkala Manggala, Kota Makassar, Sulawesi Selatan
- **Instagram**: via QR code di brosur (link perlu dikonfirmasi ke Bapak Yani)

## 6. Keputusan & Asumsi Terkonfirmasi
1. **Hosting**: Hostinger (shared hosting), DNS/SSL dikelola via Cloudflare — mengikuti pola infrastruktur yang sudah pernah dipakai sebelumnya
2. Website adalah **single-office profile** (bukan multi-cabang/multi-konsultan)
3. Bahasa utama: **Bahasa Indonesia** (opsional multi-bahasa di fase lanjutan)
4. Tidak ada kebutuhan pembayaran online / e-commerce
5. **Struktur folder proyek disiapkan sendiri oleh Anda** — dokumen rancangan ini (folder `muhammad-yani-cms-plan/`) tinggal disalin ke dalam folder project tersebut sebagai referensi untuk Claude Code
6. **Logo**: belum ada file final saat ini, sehingga dibuat placeholder logo di kode agar tampilan tetap rapi, dan admin bisa upload logo asli kapan saja lewat Pengaturan Situs tanpa perlu ubah kode (detail di `03-database-schema-features.md`)
7. **Role pengguna CMS**: 3 tingkat — Superadmin, Admin, Editor (detail matriks hak akses di `03-database-schema-features.md` bagian Role & Permission)

## 7. Ruang Lingkup (Scope)
**Modul Inti (Company Profile & CMS):**
- Landing page company profile (hero, layanan, izin & kualifikasi, tentang kami, kontak, footer)
- Form kontak/konsultasi yang mengirim ke email + tersimpan di admin panel
- CMS admin untuk kelola: layanan, izin, pengaturan situs (kontak, tagline, dsb), pesan masuk
- Tombol WhatsApp mengambang (floating WA button)
- SEO dasar (meta tag, schema LocalBusiness/Person, sitemap)

**Modul Konten Edukasi & Informasi Pajak (ditambahkan atas permintaan):**
- **Testimoni Klien** — ulasan/pengalaman klien, ditampilkan di landing page
- **Blog/Artikel Pajak** — artikel edukasi perpajakan, kategori, pencarian. Editor dapat publish langsung tanpa approval Admin (keputusan final)
- **FAQ Pajak** — pertanyaan umum seputar pajak & layanan kantor, format akordeon
- **Kalender Pajak** — pengingat jatuh tempo lapor/bayar pajak (SPT Masa, SPT Tahunan, dsb)
- **Glosarium Istilah Pajak** — kamus singkat istilah perpajakan (PPh, PPN, PTKP, dsb)
- **Pusat Unduhan** — formulir/panduan pajak yang bisa diunduh pengunjung
- **Newsletter/Info Update** — form berlangganan info pajak terbaru (opsional, ringan)

**Tidak termasuk (fase lanjutan/berisiko, perlu keputusan terpisah):**
- Kalkulator pajak otomatis (PPh/PPN) — berisiko jika hasil hitung tidak akurat dan dianggap sebagai nasihat resmi; sebaiknya dibahas terpisah dengan disclaimer hukum yang jelas jika ingin dibangun
- Sistem booking konsultasi online dengan kalender real-time
- Multi-bahasa
- Portal klien (login klien untuk cek status kasus)
