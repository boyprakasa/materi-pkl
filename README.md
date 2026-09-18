# Sistem Data Sekolah — Belajar PHP Native + Bootstrap

Aplikasi CRUD sederhana (Guru, Siswa, Kelas) dibuat dengan **PHP Native**
(tanpa framework), **Bootstrap 5** untuk tampilan, dan **routing buatan
sendiri**. Dibuat khusus sebagai bahan belajar untuk pemula.

## Struktur Folder

```
sekolah-app/
├── index.php              # Tumpuan aplikasi: config, koneksi DB, dan dispatcher routing
├── .htaccess               # (opsional, untuk Apache) agar URL bersih tanpa index.php
├── config/
│   ├── config.php           # Pengaturan umum (nama app, BASE_URL)
│   └── database.php         # Koneksi PDO ke MySQL
├── core/
│   └── Router.php           # Class Router buatan sendiri (custom routing)
├── routes/
│   └── web.php               # Daftar semua alamat URL & controller tujuannya
├── controllers/
│   ├── HomeController.php
│   ├── GuruController.php
│   ├── SiswaController.php
│   └── KelasController.php
├── models/
│   ├── Guru.php               # Query SQL untuk tabel guru
│   ├── Siswa.php               # Query SQL untuk tabel siswa
│   └── Kelas.php               # Query SQL untuk tabel kelas
├── views/
│   ├── layouts/
│   │   ├── header.php           # Buka HTML + navbar Bootstrap
│   │   └── footer.php           # Tutup HTML + script Bootstrap
│   ├── home/index.php
│   ├── guru/  (index, create, edit)
│   ├── siswa/ (index, create, edit)
│   ├── kelas/ (index, create, edit)
│   └── errors/404.php
└── database/
    └── db_sekolah.sql        # Struktur tabel + data contoh
```

## Konsep Penting: index.php sebagai "Tumpuan"

`index.php` **tidak berisi logic CRUD sama sekali**. Tugasnya hanya:
1. Load `config/config.php` & `config/database.php`
2. Load `core/Router.php`
3. Daftarkan route lewat `routes/web.php`
4. Jalankan `$router->dispatch(...)`

Semua request — apapun URL-nya — selalu masuk lewat `index.php` terlebih
dahulu (itulah kenapa disebut *front controller* / tumpuan). Dari situ,
router-lah yang menentukan controller & method mana yang dijalankan.

## Cara Instalasi

### 1. Buat database
Import `database/db_sekolah.sql` lewat phpMyAdmin, atau via terminal:
```bash
mysql -u root -p < database/db_sekolah.sql
```

### 2. Sesuaikan koneksi database (jika perlu)
Edit `config/database.php` — sesuaikan `DB_HOST`, `DB_USER`, `DB_PASS`
dengan pengaturan MySQL di komputer kamu (default: user `root`, password
kosong, sesuai standar XAMPP/Laragon).

### 3. Jalankan aplikasi

**Opsi A — pakai PHP built-in server (paling gampang, tanpa Apache):**
```bash
cd sekolah-app
php -S localhost:8000 index.php
```
Buka `http://localhost:8000` di browser. Parameter `index.php` di
belakang perintah tersebut membuat semua request lewat router kita.

**Opsi B — pakai XAMPP/Laragon (Apache):**
1. Copy folder `sekolah-app` ke `htdocs/` (XAMPP) atau `www/` (Laragon)
2. Buka `http://localhost/sekolah-app/`
3. Ubah `BASE_URL` di `config/config.php` menjadi `/sekolah-app/`
4. Pastikan module `mod_rewrite` Apache aktif (agar `.htaccess` berfungsi)

## Alur Belajar yang Disarankan

1. Baca `index.php` dulu — pahami alur tumpuannya
2. Baca `core/Router.php` — pahami cara kerja routing custom
3. Baca `routes/web.php` — lihat daftar semua alamat URL
4. Ikuti satu alur CRUD, misal Guru:
   `routes/web.php` → `controllers/GuruController.php` →
   `models/Guru.php` → `views/guru/*.php`
5. Setelah paham alur Guru, konsep yang sama berlaku untuk Siswa & Kelas

## Fitur

- CRUD Guru (NIP, nama, jenis kelamin, alamat, no HP)
- CRUD Siswa (NIS, nama, jenis kelamin, tanggal lahir, alamat, kelas)
- CRUD Kelas (nama kelas, tingkat, wali kelas — relasi ke tabel guru)
- Routing custom tanpa framework, mendukung parameter dinamis (`{id}`)
- Tampilan Bootstrap 5 (CDN, tidak perlu install apa pun)
- Proteksi dasar XSS lewat `htmlspecialchars()` di semua output
- Query database aman memakai PDO prepared statement
