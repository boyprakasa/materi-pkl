# Sistem Data Sekolah — Belajar PHP Native + Bootstrap

Aplikasi CRUD sederhana (Guru, Siswa, Kelas) dibuat dengan **PHP Native**
(tanpa framework), **Bootstrap 5** untuk tampilan, dan **routing buatan
sendiri**. Dibuat khusus sebagai bahan belajar untuk pemula.

## Struktur Folder

```
sekolah-app/
├── index.php              # Tumpuan aplikasi: config, koneksi DB, dan dispatcher routing
├── .htaccess               # (opsional, HANYA jika suatu saat pindah ke Apache — tidak dipakai Nginx)
├── nginx-laragon.conf       # Acuan konfigurasi Nginx untuk Laragon
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
dahulu (itulah kenapa disebut _front controller_ / tumpuan). Dari situ,
router-lah yang menentukan controller & method mana yang dijalankan.

## Cara Instalasi (Standar: Laragon + Nginx)

> Project ini distandarkan pakai **Laragon dengan web server Nginx**
> (bukan Apache). Pastikan saat instalasi/switch Laragon, pilih Nginx
> di menu **Laragon > Preferences > Services and ports** atau lewat
> klik kanan tray icon Laragon > **Switch to Nginx**.

### 1. Buat database

Import `database/db_sekolah.sql` lewat phpMyAdmin/HeidiSQL, atau via terminal:

```bash
mysql -u root -p < database/db_sekolah.sql
```

### 2. Sesuaikan koneksi database (jika perlu)

Edit `config/database.php` — sesuaikan `DB_HOST`, `DB_USER`, `DB_PASS`.
Default Laragon: user `root`, password kosong.

### 3. Letakkan project & buat virtual host

1. Copy folder `sekolah-app` ke `laragon/www/`
2. Buka Laragon, klik **Reload/Restart** — Laragon otomatis mendeteksi
   folder baru dan membuat virtual host `sekolah-app.test`
3. Karena Nginx, Laragon otomatis generate config `try_files` yang
   mengarahkan semua request ke `index.php` (lihat contoh lengkapnya
   di `nginx-laragon.conf` pada root project ini — kalau perlu buat
   manual, tinggal salin isinya)
4. `BASE_URL` di `config/config.php` **cukup diisi `/`** — karena
   Laragon Nginx pakai domain virtual (`sekolah-app.test`), bukan
   subfolder, jadi tidak ada prefix path tambahan

### 4. Jalankan aplikasi

Buka `http://sekolah-app.test/` di browser (klik kanan project di
Laragon > **Open with browser** juga bisa).

### Alternatif tanpa Laragon (opsional, untuk cek cepat)

```bash
cd sekolah-app
php -S localhost:8000 index.php
```

Buka `http://localhost:8000`. `BASE_URL` tetap `/`.

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

## Cara Menambah Modul CRUD Baru

Modul Guru, Siswa, dan Kelas dibuat dengan pola yang **sama persis**.
Untuk menambah modul baru (misal modul `mapel` / mata pelajaran), ikuti
urutan berikut — urutan ini penting, jangan dibalik:

### 1. Buat tabel di database

Tambahkan `CREATE TABLE` baru di `database/db_sekolah.sql` (atau lewat
phpMyAdmin langsung), lengkap dengan primary key `id` dan foreign key
jika modul ini berelasi ke tabel lain.

### 2. Buat Model — `models/NamaModel.php`

Class ini isinya query SQL saja: `getAll()`, `find($id)`, `create($data)`,
`update($id, $data)`, `delete($id)`. Contoh kerangkanya:

```php
<?php
class Mapel
{
    private PDO $db;

    public function __construct()
    {
        global $pdo;
        $this->db = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM mapel ORDER BY nama_mapel ASC");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM mapel WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO mapel (kode_mapel, nama_mapel) VALUES (?, ?)");
        return $stmt->execute([$data['kode_mapel'], $data['nama_mapel']]);
    }

    public function update($id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE mapel SET kode_mapel = ?, nama_mapel = ? WHERE id = ?");
        return $stmt->execute([$data['kode_mapel'], $data['nama_mapel'], $id]);
    }

    public function delete($id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM mapel WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
```

### 3. Buat Controller — `controllers/NamaController.php`

Isinya method `index()`, `create()`, `store()`, `edit($id)`, `update($id)`,
`delete($id)` — contoh langsung salin dari `GuruController.php` lalu
ganti nama class dan nama field-nya.

### 4. Buat Views — `views/nama_modul/`

Buat 3 file: `index.php` (tabel data), `create.php` (form tambah),
`edit.php` (form edit). Salin dari `views/guru/` lalu sesuaikan
kolomnya.

### 5. Daftarkan Route — `routes/web.php`

Tambahkan 6 baris di akhir file, pola sama seperti modul lain:

```php
// ----------------------- CRUD Mapel -----------------------
$router->get('/mapel', ['MapelController', 'index']);
$router->get('/mapel/create', ['MapelController', 'create']);
$router->post('/mapel/store', ['MapelController', 'store']);
$router->get('/mapel/edit/{id}', ['MapelController', 'edit']);
$router->post('/mapel/update/{id}', ['MapelController', 'update']);
$router->get('/mapel/delete/{id}', ['MapelController', 'delete']);
```

### 6. Tambahkan Link di Navbar

Edit `views/layouts/header.php`, tambahkan `<li>` baru di dalam
`<ul class="navbar-nav ms-auto">` mengarah ke `<?= BASE_URL ?>mapel`.

**Ringkasan urutan:** Tabel DB → Model → Controller → Views → Route →
Navbar. Kalau salah satu langkah dilewati (misal route belum
didaftarkan tapi controller sudah dipanggil di menu), aplikasi akan
menampilkan halaman 404.

## Saran Modul Lanjutan (Latihan Siswa)

Modul Guru/Siswa/Kelas adalah modul dasar (CRUD 1 tabel + relasi
sederhana). Untuk latihan tugas selanjutnya, modul berikut disusun
dari yang paling mirip pola dasar sampai yang butuh logic tambahan:

1. **Mata Pelajaran (mapel)** — CRUD paling sederhana, cocok untuk
   latihan pertama meniru pola Guru (tanpa relasi).
2. **Jadwal Pelajaran (jadwal)** — relasi ke 3 tabel sekaligus
   (kelas, mapel, guru) + field hari & jam; melatih JOIN lebih dari
   satu tabel seperti di modul Kelas/Siswa.
3. **Nilai Siswa (nilai)** — relasi ke siswa & mapel, plus input
   angka dan validasi rentang nilai (0–100).
4. **Absensi (absensi)** — relasi ke siswa + tanggal, dengan status
   (Hadir/Izin/Sakit/Alpa); melatih form dengan banyak pilihan
   (radio/select) dan filter data berdasarkan tanggal.
5. **Tahun Ajaran / Semester (tahun_ajaran)** — data referensi
   sederhana, tapi dipakai sebagai filter di modul Nilai & Absensi;
   melatih konsep "tabel master" yang dipakai modul lain.
6. **Login Admin (auth)** — bukan CRUD data, tapi CRUD session:
   melatih penggunaan `$_SESSION`, autentikasi, dan middleware
   sederhana (cek login sebelum masuk ke route lain lewat Router).

Urutan di atas sengaja dari yang paling sederhana ke yang paling
kompleks, supaya siswa terbiasa dulu dengan pola CRUD dasar sebelum
menghadapi relasi banyak tabel dan logic tambahan (validasi, sesi,
filter).

## Acuan Tabel untuk Modul Lanjutan

Struktur tabel berikut jadi acuan kolom & tipe data untuk 6 modul di
atas. Silakan sesuaikan nama/tipe kalau kebutuhan tugas berbeda —
ini hanya starting point.

### 1. `mapel`

| Kolom      | Tipe Data             | Keterangan        |
| ---------- | --------------------- | ----------------- |
| id         | INT AUTO_INCREMENT PK |                   |
| kode_mapel | VARCHAR(10) NOT NULL  | Contoh: MTK, BIND |
| nama_mapel | VARCHAR(100) NOT NULL |                   |

### 2. `jadwal`

| Kolom       | Tipe Data                                                      | Keterangan |
| ----------- | -------------------------------------------------------------- | ---------- |
| id          | INT AUTO_INCREMENT PK                                          |            |
| kelas_id    | INT, FK → kelas(id)                                            |            |
| mapel_id    | INT, FK → mapel(id)                                            |            |
| guru_id     | INT, FK → guru(id)                                             |            |
| hari        | ENUM('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL |            |
| jam_mulai   | TIME NOT NULL                                                  |            |
| jam_selesai | TIME NOT NULL                                                  |            |

### 3. `nilai`

| Kolom       | Tipe Data                          | Keterangan             |
| ----------- | ---------------------------------- | ---------------------- |
| id          | INT AUTO_INCREMENT PK              |                        |
| siswa_id    | INT, FK → siswa(id)                |                        |
| mapel_id    | INT, FK → mapel(id)                |                        |
| jenis_nilai | ENUM('Tugas','UTS','UAS') NOT NULL |                        |
| nilai       | DECIMAL(5,2) NOT NULL              | Validasi 0–100 di form |
| keterangan  | TEXT NULL                          |                        |

### 4. `absensi`

| Kolom      | Tipe Data                                    | Keterangan |
| ---------- | -------------------------------------------- | ---------- |
| id         | INT AUTO_INCREMENT PK                        |            |
| siswa_id   | INT, FK → siswa(id)                          |            |
| tanggal    | DATE NOT NULL                                |            |
| status     | ENUM('Hadir','Izin','Sakit','Alpa') NOT NULL |            |
| keterangan | TEXT NULL                                    |            |

### 5. `tahun_ajaran`

| Kolom             | Tipe Data                                            | Keterangan        |
| ----------------- | ---------------------------------------------------- | ----------------- |
| id                | INT AUTO_INCREMENT PK                                |                   |
| nama_tahun_ajaran | VARCHAR(20) NOT NULL                                 | Contoh: 2025/2026 |
| semester          | ENUM('Ganjil','Genap') NOT NULL                      |                   |
| status            | ENUM('Aktif','Nonaktif') NOT NULL DEFAULT 'Nonaktif' |                   |

### 6. `admin` (untuk modul Login)

| Kolom        | Tipe Data                           | Keterangan                                        |
| ------------ | ----------------------------------- | ------------------------------------------------- |
| id           | INT AUTO_INCREMENT PK               |                                                   |
| username     | VARCHAR(50) NOT NULL UNIQUE         |                                                   |
| password     | VARCHAR(255) NOT NULL               | Simpan hasil `password_hash()`, jangan plain text |
| nama_lengkap | VARCHAR(100) NULL                   |                                                   |
| created_at   | TIMESTAMP DEFAULT CURRENT_TIMESTAMP |                                                   |

## Roadmap Materi Setelah Modul Lanjutan

Setelah 6 modul lanjutan (`mapel`, `jadwal`, `nilai`, `absensi`,
`tahun_ajaran`, `admin`) diterapkan, siswa sudah menguasai CRUD +
relasi banyak tabel + session dasar. Materi berikutnya, urut dari
yang paling nyambung ke yang paling jauh dari pola CRUD dasar:

1. **Autentikasi & Otorisasi bertingkat (role-based)** — modul
   `admin` dikembangkan jadi multi-role (admin/guru/siswa), tiap
   role lihat menu berbeda; bikin "middleware" sendiri di
   `Router.php` untuk cek session sebelum masuk controller tertentu.
2. **Pencarian, filter, dan pagination** — form filter (per kelas,
   per tanggal, per mapel) + pagination manual pakai `LIMIT`/`OFFSET`,
   penting begitu data nilai/absensi mulai banyak.
3. **Upload file** — foto profil guru/siswa, atau dokumen pendukung
   di modul absensi; melatih `$_FILES`, validasi tipe/ukuran file.
4. **Export & cetak** — export Excel/CSV (rekap nilai/absensi) atau
   cetak PDF (rapor siswa, surat keterangan).
5. **Dashboard & visualisasi data** — grafik nilai per kelas / rekap
   kehadiran pakai Chart.js, dari query `GROUP BY`/`AVG()`.
6. **AJAX / fetch tanpa reload** — aksi delete/filter/search tanpa
   reload halaman penuh, pengantar sebelum konsep SPA/REST API.
7. **REST API sederhana** — endpoint JSON dari modul yang sudah ada
   (`/api/siswa`, dst), modal dasar untuk versi mobile app nantinya.
8. **Keamanan lanjutan** — CSRF token di form, rate limiting
   sederhana untuk login, audit log (siapa mengubah data apa & kapan).
9. **(Opsional, tahap akhir) Migrasi konsep ke framework** — setelah
   paham cara kerja routing/model/controller manual, transisi ke
   Laravel jadi lebih masuk akal karena siswa sudah tahu apa yang
   "disembunyikan" framework di baliknya.
