# Validasi Input PHP

## 1. Apa itu Validasi Input?

Validasi input adalah proses **memeriksa data yang dikirim oleh pengguna** sebelum data tersebut diproses atau disimpan ke database.

Contohnya, pada form data siswa:

- NIS wajib diisi.
- NIS hanya boleh berisi angka.
- Nama wajib diisi.
- Email harus memiliki format email yang benar.
- Jenis kelamin hanya boleh `L` atau `P`.
- Kelas harus berasal dari pilihan yang tersedia.

Validasi penting untuk:

1. Mencegah data yang tidak sesuai masuk ke database.
2. Memberikan informasi kepada pengguna ketika terjadi kesalahan.
3. Menjaga konsistensi data.
4. Mengurangi kesalahan pada proses aplikasi.

---

# 2. Validasi HTML dan Validasi PHP

Validasi dapat dilakukan pada dua sisi:

```text
Browser
   ↓
Validasi HTML
   ↓
Server
   ↓
Validasi PHP
   ↓
Database
```

Keduanya memiliki fungsi yang berbeda.

## Validasi HTML

Contoh:

```html
<input type="text" name="nis" required />
```

Browser akan membantu memastikan input tidak kosong.

Contoh lainnya:

```html
<input type="email" name="email" />
```

Browser akan memeriksa format email secara dasar.

Namun, **validasi HTML tidak cukup**.

Pengguna dapat mengirim request secara langsung tanpa melalui validasi browser. Karena itu, validasi tetap harus dilakukan di PHP.

---

# 3. Validasi di PHP

Data dari form biasanya diambil menggunakan `$_POST`.

Contoh:

```php
$nis = trim($_POST['nis'] ?? '');
$nama = trim($_POST['nama'] ?? '');
```

### Mengapa menggunakan `trim()`?

`trim()` digunakan untuk menghilangkan spasi di awal dan akhir input.

Contoh:

```text
"  Budi  "
```

menjadi:

```text
"Budi"
```

---

# 4. Validasi Input Kosong

Gunakan kondisi:

```php
if ($nis === '') {
    $errors[] = 'NIS wajib diisi.';
}
```

Jika NIS kosong, pesan error dimasukkan ke array `$errors`.

Contoh:

```php
$errors = [];

if ($nis === '') {
    $errors[] = 'NIS wajib diisi.';
}

if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
}
```

Jika kedua input kosong:

```php
$errors = [
    'NIS wajib diisi.',
    'Nama wajib diisi.'
];
```

---

# 5. Validasi Angka

Misalnya NIS hanya boleh berisi angka.

Gunakan:

```php
if (!preg_match('/^[0-9]+$/', $nis)) {
    $errors[] = 'NIS hanya boleh berisi angka.';
}
```

### Contoh

| Input    | Hasil       |
| -------- | ----------- |
| `12345`  | Valid       |
| `00123`  | Valid       |
| `123456` | Valid       |
| `qwe`    | Tidak valid |
| `123abc` | Tidak valid |
| `12-34`  | Tidak valid |
| `12 34`  | Tidak valid |

---

# 6. Validasi Panjang Karakter

Misalnya NIS maksimal 20 karakter:

```php
if (strlen($nis) > 20) {
    $errors[] = 'NIS maksimal 20 angka.';
}
```

Untuk nama:

```php
if (strlen($nama) > 100) {
    $errors[] = 'Nama maksimal 100 karakter.';
}
```

Validasi PHP sebaiknya disesuaikan dengan struktur database.

Contoh:

```sql
nis VARCHAR(20)
nama VARCHAR(100)
```

Maka validasi:

```php
strlen($nis) <= 20
strlen($nama) <= 100
```

---

# 7. Validasi Email

PHP menyediakan `filter_var()` untuk memeriksa format email.

```php
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}
```

Karena email pada contoh ini bersifat opsional, kita hanya melakukan validasi format jika email diisi.

Contoh:

```text
budi@gmail.com
```

Valid.

Sedangkan:

```text
budi@
```

Tidak valid.

---

# 8. Validasi Pilihan

Misalnya jenis kelamin hanya memiliki dua pilihan:

```text
L = Laki-laki
P = Perempuan
```

Validasi:

```php
if (!in_array($jenis_kelamin, ['L', 'P'], true)) {
    $errors[] = 'Jenis kelamin tidak valid.';
}
```

Dengan validasi ini, pengguna tidak dapat mengirim nilai sembarangan seperti:

```text
A
X
abc
123
```

---

# 9. Validasi Select

Misalnya pilihan kelas:

```php
$kelas_valid = [
    'X RPL 1',
    'X RPL 2',
    'XI RPL 1',
    'XI RPL 2',
    'XII RPL 1',
    'XII RPL 2',
];
```

Kemudian:

```php
if (!in_array($kelas, $kelas_valid, true)) {
    $errors[] = 'Kelas tidak valid.';
}
```

Dengan demikian PHP tidak hanya mempercayai nilai yang dikirim dari `<select>`.

---

# 10. Validasi Tanggal

Untuk tanggal lahir:

```php
if ($tanggal_lahir !== '') {
    $date = DateTime::createFromFormat('Y-m-d', $tanggal_lahir);

    if (!$date || $date->format('Y-m-d') !== $tanggal_lahir) {
        $errors[] = 'Tanggal lahir tidak valid.';
    }
}
```

Format yang diharapkan:

```text
YYYY-MM-DD
```

Contoh:

```text
2008-05-20
```

---

# 11. Mengumpulkan Error

Daripada langsung menghentikan proses ketika menemukan satu kesalahan, kita dapat mengumpulkan semua error.

Contoh:

```php
$errors = [];

if ($nis === '') {
    $errors[] = 'NIS wajib diisi.';
}

if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}
```

Kemudian periksa:

```php
if (!empty($errors)) {
    // proses ketika validasi gagal
}
```

---

# 12. Jangan Simpan Data Jika Validasi Gagal

Ini merupakan bagian penting.

Validasi harus dilakukan **sebelum query INSERT atau UPDATE**.

Contoh:

```php
if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);

    header('Location: index.php');
    exit;
}
```

Karena terdapat:

```php
exit;
```

program berhenti dan query database tidak dijalankan.

Alurnya:

```text
Input
  ↓
Validasi
  ↓
Ada error?
  ├── Ya → kembali ke form
  │
  └── Tidak → simpan ke database
```

---

# 13. Validasi pada Create

Pada proses create, validasi dilakukan sebelum `INSERT`.

Contoh:

```php
$nis = trim($_POST['nis'] ?? '');
$nama = trim($_POST['nama'] ?? '');

$errors = [];

if ($nis === '') {
    $errors[] = 'NIS wajib diisi.';
} elseif (!preg_match('/^[0-9]+$/', $nis)) {
    $errors[] = 'NIS hanya boleh berisi angka.';
} elseif (strlen($nis) > 20) {
    $errors[] = 'NIS maksimal 20 angka.';
}

if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
}

if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);

    header('Location: index.php');
    exit;
}
```

Jika validasi berhasil, barulah:

```php
INSERT INTO siswa (...)
```

dijalankan.

---

# 14. Validasi pada Update

Validasi **juga harus dilakukan pada proses update**.

Jangan menganggap data dari database sebelumnya sudah benar.

Contoh:

```php
$nis = trim($_POST['nis'] ?? '');
$nama = trim($_POST['nama'] ?? '');

$errors = [];

if ($nis === '') {
    $errors[] = 'NIS wajib diisi.';
} elseif (!preg_match('/^[0-9]+$/', $nis)) {
    $errors[] = 'NIS hanya boleh berisi angka.';
} elseif (strlen($nis) > 20) {
    $errors[] = 'NIS maksimal 20 angka.';
}

if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
}

if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);

    header('Location: edit.php?id=' . urlencode((string) $id));
    exit;
}
```

Barulah setelah validasi berhasil:

```php
UPDATE siswa
SET ...
WHERE id = ?
```

---

# 15. Menampilkan Kembali Input Ketika Validasi Gagal

Masalah yang sering terjadi adalah:

```text
User mengisi form
       ↓
Validasi gagal
       ↓
Kembali ke form
       ↓
Input menjadi kosong
```

Hal ini terjadi karena data POST sudah hilang setelah redirect.

Solusinya adalah menyimpan input sementara di session.

Contoh:

```php
$_SESSION['old'] = [
    'nis' => $nis,
    'nama' => $nama,
    'email' => $email,
    'no_hp' => $no_hp,
    'jenis_kelamin' => $jenis_kelamin,
    'kelas' => $kelas,
    'tanggal_lahir' => $tanggal_lahir,
    'alamat' => $alamat,
];
```

Kemudian redirect:

```php
header('Location: index.php');
exit;
```

---

# 16. Menggunakan Old Input pada Form

Di `index.php`:

```php
$old = $_SESSION['old'] ?? [];

unset($_SESSION['old']);
```

Kemudian input:

```php
<input
    type="text"
    name="nis"
    value="<?= htmlspecialchars($old['nis'] ?? '') ?>"
>
```

Untuk nama:

```php
<input
    type="text"
    name="nama"
    value="<?= htmlspecialchars($old['nama'] ?? '') ?>"
>
```

Dengan demikian input sebelumnya tetap ditampilkan.

---

# 17. Old Input pada Edit

Pada halaman edit terdapat dua sumber data:

1. Data dari database.
2. Data sementara dari session jika validasi gagal.

Contoh:

```php
value="<?= htmlspecialchars($old['nis'] ?? $row['nis']) ?>"
```

Artinya:

```text
Jika ada old input
    ↓
gunakan old input

Jika tidak ada
    ↓
gunakan data database
```

Contoh lengkap:

```php
<input
    type="text"
    name="nis"
    value="<?= htmlspecialchars($old['nis'] ?? $row['nis']) ?>"
    required
>
```

---

# 18. Menampilkan Pesan Error

Session dapat digunakan untuk menyimpan pesan error:

```php
$_SESSION['error'] = 'NIS hanya boleh berisi angka.';
```

Kemudian pada halaman form:

```php
<?php if (isset($_SESSION['error'])): ?>

    <div class="alert alert-error">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>
```

---

# 19. Contoh Validasi Data Siswa

Berikut contoh aturan validasi yang digunakan dalam aplikasi:

| Field         | Aturan                             |
| ------------- | ---------------------------------- |
| NIS           | Wajib, angka, maksimal 20 karakter |
| Nama          | Wajib, maksimal 100 karakter       |
| Email         | Opsional, format email             |
| No HP         | Opsional, maksimal 20 karakter     |
| Jenis Kelamin | Wajib, `L` atau `P`                |
| Kelas         | Wajib, harus sesuai pilihan        |
| Tanggal Lahir | Opsional, format tanggal           |
| Alamat        | Opsional                           |

Contoh implementasi:

```php
$errors = [];

if ($nis === '') {
    $errors[] = 'NIS wajib diisi.';
} elseif (!preg_match('/^[0-9]+$/', $nis)) {
    $errors[] = 'NIS hanya boleh berisi angka.';
} elseif (strlen($nis) > 20) {
    $errors[] = 'NIS maksimal 20 angka.';
}

if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
} elseif (strlen($nama) > 100) {
    $errors[] = 'Nama maksimal 100 karakter.';
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}

if ($no_hp !== '' && strlen($no_hp) > 20) {
    $errors[] = 'Nomor HP maksimal 20 karakter.';
}

if (!in_array($jenis_kelamin, ['L', 'P'], true)) {
    $errors[] = 'Jenis kelamin tidak valid.';
}

$kelas_valid = [
    'X RPL 1',
    'X RPL 2',
    'XI RPL 1',
    'XI RPL 2',
    'XII RPL 1',
    'XII RPL 2',
];

if (!in_array($kelas, $kelas_valid, true)) {
    $errors[] = 'Kelas tidak valid.';
}
```

---

# 20. Validasi Data di Database

Validasi PHP memeriksa **nilai input**.

Namun sebelum melakukan `UPDATE` atau `DELETE`, aplikasi juga perlu memastikan bahwa **data yang dituju benar-benar ada di database**.

Contohnya ketika melakukan update:

```text
User membuka:

edit.php?id=10
```

Kemudian aplikasi harus memastikan:

```text
Apakah siswa dengan ID 10 ada?
```

Contoh:

```php
$stmt = $pdo->prepare("
    SELECT id
    FROM siswa
    WHERE id = ?
    LIMIT 1
");

$stmt->execute([$id]);

if (!$stmt->fetch()) {
    throw new RuntimeException('Data siswa tidak ditemukan.');
}
```

Dengan demikian aplikasi tidak langsung melakukan `UPDATE` terhadap ID yang tidak ada.

---

# 21. Validasi NIS Unik

Selain validasi format, NIS juga harus diperiksa agar tidak digunakan oleh siswa lain.

## Create

Pada Create, cari NIS yang sama:

```php
$stmt = $pdo->prepare("
    SELECT id
    FROM siswa
    WHERE nis = ?
    LIMIT 1
");

$stmt->execute([$nis]);

if ($stmt->fetch()) {
    throw new RuntimeException('NIS sudah digunakan.');
}
```

Kemudian jika tidak ditemukan, proses `INSERT` dapat dilanjutkan.

## Update

Pada Update, siswa yang sedang diedit tidak boleh dianggap sebagai duplikat.

Gunakan:

```php
$stmt = $pdo->prepare("
    SELECT id
    FROM siswa
    WHERE nis = ?
      AND id != ?
    LIMIT 1
");

$stmt->execute([$nis, $id]);

if ($stmt->fetch()) {
    throw new RuntimeException(
        'NIS sudah digunakan oleh siswa lain.'
    );
}
```

Bagian:

```sql
AND id != ?
```

berarti:

> Cari NIS yang sama tetapi bukan milik siswa yang sedang diedit.

---

# 22. Database Constraint

Validasi PHP bukan satu-satunya perlindungan.

Database juga sebaiknya memiliki constraint.

Contoh tabel:

```sql
CREATE TABLE siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    no_hp VARCHAR(20),
    jenis_kelamin CHAR(1),
    kelas VARCHAR(20),
    alamat TEXT,
    tanggal_lahir DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL
);
```

Perhatikan:

```sql
nis VARCHAR(20) NOT NULL UNIQUE
```

Memiliki tiga fungsi penting:

```text
VARCHAR(20)
    ↓
Maksimal 20 karakter

NOT NULL
    ↓
Tidak boleh NULL

UNIQUE
    ↓
Tidak boleh ada NIS yang sama
```

Jadi terdapat dua lapisan:

```text
Validasi PHP
    ↓
Memeriksa input
    ↓
Database Constraint
    ↓
Melindungi data
```

---

# 23. Mengapa Validasi PHP dan Database Sama-sama Dibutuhkan?

Misalnya aplikasi melakukan pengecekan:

```php
SELECT id FROM siswa WHERE nis = ?
```

dan hasilnya tidak ditemukan.

Kemudian aplikasi melakukan:

```sql
INSERT INTO siswa (...)
```

Tetapi ada kemungkinan request lain memasukkan NIS yang sama pada waktu yang hampir bersamaan.

Karena itu database tetap harus memiliki:

```sql
UNIQUE
```

Validasi PHP memberikan pesan yang lebih mudah dipahami pengguna.

Database constraint memberikan perlindungan pada tingkat database.

---

# 24. Apa itu Transaction?

Transaction adalah mekanisme database untuk memastikan beberapa operasi database diperlakukan sebagai **satu kesatuan proses**.

Contoh sederhana:

```text
Mulai transaction
      ↓
Query 1
      ↓
Query 2
      ↓
Query 3
      ↓
Semua berhasil?
   ├── Ya → COMMIT
   │
   └── Tidak → ROLLBACK
```

Jika semua operasi berhasil, perubahan disimpan menggunakan:

```php
$pdo->commit();
```

Jika terjadi kesalahan:

```php
$pdo->rollBack();
```

---

# 25. Mengapa Transaction Diperlukan?

Bayangkan terdapat beberapa proses:

```text
Update data siswa
       ↓
Update data lainnya
       ↓
Simpan riwayat
```

Jika query pertama berhasil tetapi query berikutnya gagal:

```text
Query 1 → berhasil
Query 2 → berhasil
Query 3 → gagal
```

Tanpa transaction, sebagian perubahan mungkin sudah tersimpan.

Dengan transaction:

```text
Query 1 → berhasil
Query 2 → berhasil
Query 3 → gagal
             ↓
         ROLLBACK
             ↓
Semua perubahan dibatalkan
```

Database kembali ke kondisi sebelum transaction dimulai.

---

# 26. Transaction pada Create

Contoh proses Create:

```php
try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        INSERT INTO siswa (
            nis,
            nama,
            email,
            no_hp,
            jenis_kelamin,
            kelas,
            alamat,
            tanggal_lahir
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $nis,
        $nama,
        $email !== '' ? $email : null,
        $no_hp !== '' ? $no_hp : null,
        $jenis_kelamin,
        $kelas,
        $alamat !== '' ? $alamat : null,
        $tanggal_lahir !== '' ? $tanggal_lahir : null,
    ]);

    $pdo->commit();

} catch (PDOException $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['error'] = 'Data siswa gagal disimpan.';
}
```

Alurnya:

```text
Validasi input
      ↓
Cek database
      ↓
beginTransaction()
      ↓
INSERT
      ↓
Berhasil?
 ├── Ya → commit()
 │
 └── Tidak → rollBack()
```

---

# 27. Transaction pada Update

Contoh proses Update:

```php
try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        UPDATE siswa
        SET
            nis = ?,
            nama = ?,
            email = ?,
            no_hp = ?,
            jenis_kelamin = ?,
            kelas = ?,
            alamat = ?,
            tanggal_lahir = ?,
            updated_at = NOW()
        WHERE id = ?
    ");

    $stmt->execute([
        $nis,
        $nama,
        $email !== '' ? $email : null,
        $no_hp !== '' ? $no_hp : null,
        $jenis_kelamin,
        $kelas,
        $alamat !== '' ? $alamat : null,
        $tanggal_lahir !== '' ? $tanggal_lahir : null,
        $id,
    ]);

    $pdo->commit();

} catch (PDOException $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['error'] = 'Data siswa gagal diperbarui.';
}
```

---

# 28. Urutan yang Benar

Untuk Create dan Update, urutan proses sebaiknya:

```text
1. Ambil input
       ↓
2. Validasi input
       ↓
3. Jika error → kembali ke form
       ↓
4. Cek data yang berkaitan di database
       ↓
5. Mulai transaction
       ↓
6. INSERT / UPDATE
       ↓
7. Commit
       ↓
8. Redirect
```

Jika terjadi error database:

```text
INSERT / UPDATE
       ↓
   Exception
       ↓
   ROLLBACK
       ↓
Simpan pesan error
       ↓
   Redirect
```

---

# 29. Perbedaan Validasi, Constraint, dan Transaction

Ketiganya memiliki fungsi berbeda.

| Fitur               | Fungsi                                            |
| ------------------- | ------------------------------------------------- |
| Validasi PHP        | Memeriksa input pengguna                          |
| Database Constraint | Menjaga aturan data di database                   |
| Transaction         | Menjaga beberapa operasi database tetap konsisten |

Contoh:

```text
NIS = "qwe"
      ↓
Validasi PHP
      ↓
DITOLAK
```

NIS:

```text
12345
```

tetapi sudah digunakan:

```text
Validasi PHP
      ↓
Cek database
      ↓
DITOLAK
```

Sedangkan jika terjadi kegagalan ketika database sedang melakukan beberapa perubahan:

```text
Transaction
      ↓
ROLLBACK
```

---

# 30. Kesimpulan

Validasi aplikasi dan database bukanlah hal yang sama.

Validasi PHP digunakan untuk memastikan input pengguna sesuai dengan aturan aplikasi.

Database constraint digunakan sebagai perlindungan terakhir terhadap data yang tidak konsisten.

Transaction digunakan untuk memastikan perubahan database dapat dilakukan secara aman.

Alur keseluruhan:

```text
                 FORM
                   ↓
            Validasi HTML
                   ↓
             Validasi PHP
                   ↓
              Ada error?
             /          \
           Ya            Tidak
           ↓               ↓
     Old Input +       Cek Database
     Session Error          ↓
           ↓            Data valid?
       Redirect        /           \
                     Tidak          Ya
                       ↓             ↓
                  Error Session   Transaction
                                     ↓
                                INSERT / UPDATE
                                     ↓
                                  Berhasil?
                                 /        \
                               Tidak       Ya
                                 ↓          ↓
                             ROLLBACK     COMMIT
                                 ↓          ↓
                              Error      Success
                                 \          /
                                  Redirect
                                     ↓
                                   Form
```

Prinsip utamanya:

> **Validasi PHP melindungi proses aplikasi, database constraint melindungi integritas data, dan transaction melindungi konsistensi perubahan database.**
