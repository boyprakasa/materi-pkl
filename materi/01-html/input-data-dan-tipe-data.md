# Input Data HTML dan Tipe Data MySQL

## 1. Input Data pada HTML

HTML menyediakan berbagai jenis input untuk menerima data dari pengguna.

### Text

Digunakan untuk menerima teks biasa.

```html
<label for="nama">Nama Lengkap</label>
<input type="text" id="nama" name="nama">
```

Contoh data:

```text
Budi Santoso
```

---

### Number

Digunakan untuk menerima angka.

```html
<label for="umur">Umur</label>
<input type="number" id="umur" name="umur">
```

Contoh data:

```text
17
```

---

### Email

Digunakan untuk menerima alamat email.

```html
<label for="email">Email</label>
<input type="email" id="email" name="email">
```

Contoh data:

```text
budi@example.com
```

---

### Password

Digunakan untuk menerima data rahasia seperti password.

```html
<label for="password">Password</label>
<input type="password" id="password" name="password">
```

Contoh data:

```text
rahasia123
```

> Browser akan menyembunyikan karakter yang diketik.

---

### Telephone

Digunakan untuk menerima nomor telepon.

```html
<label for="no_hp">No. HP</label>
<input type="tel" id="no_hp" name="no_hp">
```

Contoh data:

```text
081234567890
```

> Nomor telepon sebaiknya disimpan sebagai `VARCHAR`, bukan `INT`, karena nomor telepon bukan digunakan untuk perhitungan dan dapat memiliki angka `0` di awal.

---

### Date

Digunakan untuk memilih tanggal.

```html
<label for="tanggal_lahir">Tanggal Lahir</label>
<input type="date" id="tanggal_lahir" name="tanggal_lahir">
```

Contoh data:

```text
2008-05-20
```

---

### Time

Digunakan untuk memilih waktu.

```html
<label for="jam">Jam Masuk</label>
<input type="time" id="jam" name="jam">
```

Contoh data:

```text
07:00
```

---

### Datetime Local

Digunakan untuk memilih tanggal dan waktu.

```html
<label for="tanggal">Tanggal dan Waktu</label>
<input type="datetime-local" id="tanggal" name="tanggal">
```

Contoh data:

```text
2026-09-17 07:30
```

---

### Radio

Digunakan untuk memilih **satu pilihan** dari beberapa pilihan.

```html
<label>Jenis Kelamin</label>

<label>
    <input type="radio" name="jenis_kelamin" value="L">
    Laki-laki
</label>

<label>
    <input type="radio" name="jenis_kelamin" value="P">
    Perempuan
</label>
```

Contoh data:

```text
L
```

atau:

```text
P
```

---

### Checkbox

Digunakan untuk memilih **satu atau beberapa pilihan**.

```html
<label>Hobi</label>

<label>
    <input type="checkbox" name="hobi[]" value="Membaca">
    Membaca
</label>

<label>
    <input type="checkbox" name="hobi[]" value="Olahraga">
    Olahraga
</label>

<label>
    <input type="checkbox" name="hobi[]" value="Musik">
    Musik
</label>
```

Contoh data:

```text
Membaca
Olahraga
Musik
```

---

### Select

Digunakan untuk membuat pilihan dalam bentuk dropdown.

```html
<label for="kelas">Kelas</label>

<select id="kelas" name="kelas">
    <option value="">-- Pilih Kelas --</option>
    <option value="X RPL 1">X RPL 1</option>
    <option value="X RPL 2">X RPL 2</option>
    <option value="XI RPL 1">XI RPL 1</option>
</select>
```

Contoh data:

```text
X RPL 1
```

---

### Textarea

Digunakan untuk menerima teks yang lebih panjang.

```html
<label for="alamat">Alamat</label>

<textarea id="alamat" name="alamat" rows="4"></textarea>
```

Contoh data:

```text
Jl. Contoh No. 10, Sidoarjo
```

---

### File

Digunakan untuk mengunggah file.

```html
<label for="foto">Foto</label>
<input type="file" id="foto" name="foto">
```

Contoh file:

```text
foto.jpg
```

Untuk upload file, form harus menggunakan:

```html
<form method="POST" enctype="multipart/form-data">
```

---

### Color

Digunakan untuk memilih warna.

```html
<label for="warna">Warna</label>
<input type="color" id="warna" name="warna">
```

Contoh data:

```text
#ff0000
```

---

### Range

Digunakan untuk memilih nilai dalam rentang tertentu.

```html
<label for="nilai">Nilai</label>
<input type="range" id="nilai" name="nilai" min="0" max="100">
```

Contoh data:

```text
80
```

---

### URL

Digunakan untuk menerima alamat website.

```html
<label for="website">Website</label>
<input type="url" id="website" name="website">
```

Contoh data:

```text
https://example.com
```

---

### Search

Digunakan untuk input pencarian.

```html
<label for="pencarian">Pencarian</label>
<input type="search" id="pencarian" name="pencarian">
```

Contoh data:

```text
Budi
```

---

# 2. Tipe Data pada MySQL

Setelah data diterima melalui HTML dan diproses menggunakan PHP, data biasanya disimpan ke database.

MySQL menyediakan beberapa tipe data untuk menentukan jenis data yang dapat disimpan.

---

## VARCHAR

Digunakan untuk teks dengan panjang yang dapat berubah.

```sql
nama VARCHAR(100)
```

Contoh data:

```text
Budi Santoso
```

Biasanya digunakan untuk:

* Nama
* Email
* Nomor HP
* Alamat singkat
* Username

---

## CHAR

Digunakan untuk teks dengan panjang tetap.

```sql
jenis_kelamin CHAR(1)
```

Contoh:

```text
L
P
```

Cocok untuk data yang panjangnya selalu sama.

---

## TEXT

Digunakan untuk teks yang panjang.

```sql
alamat TEXT
```

Contoh:

```text
Jl. Contoh No. 10, Kecamatan Sidoarjo,
Kabupaten Sidoarjo, Jawa Timur.
```

Cocok untuk:

* Alamat panjang
* Deskripsi
* Catatan
* Artikel

---

## INT

Digunakan untuk bilangan bulat.

```sql
umur INT
```

Contoh:

```text
17
```

Cocok untuk:

* Umur
* Jumlah
* ID
* Stok

---

## DECIMAL

Digunakan untuk angka desimal yang membutuhkan ketelitian.

```sql
harga DECIMAL(12,2)
```

Contoh:

```text
150000.00
```

Cocok untuk:

* Harga
* Gaji
* Nilai uang
* Jumlah transaksi

> Untuk nilai uang, gunakan `DECIMAL`, bukan `FLOAT`, agar lebih tepat untuk perhitungan keuangan.

---

## DATE

Digunakan untuk menyimpan tanggal.

```sql
tanggal_lahir DATE
```

Contoh:

```text
2008-05-20
```

Format:

```text
YYYY-MM-DD
```

---

## TIME

Digunakan untuk menyimpan waktu.

```sql
jam_masuk TIME
```

Contoh:

```text
07:00:00
```

---

## DATETIME

Digunakan untuk menyimpan tanggal dan waktu.

```sql
created_at DATETIME
```

Contoh:

```text
2026-09-17 09:30:00
```

Biasanya digunakan untuk:

* Waktu dibuat
* Waktu diubah
* Waktu transaksi
* Waktu aktivitas

---

## BOOLEAN

Digunakan untuk nilai benar atau salah.

```sql
aktif BOOLEAN
```

Contoh:

```text
1
```

atau:

```text
0
```

Pada MySQL, `BOOLEAN` pada dasarnya merupakan alias dari `TINYINT(1)`.

---

# 3. Hubungan HTML Input dengan MySQL

Input HTML dan tipe data MySQL tidak selalu memiliki nama yang sama.

| HTML Input       | Contoh Data                                 | MySQL                    |
| ---------------- | ------------------------------------------- | ------------------------ |
| `text`           | Budi                                        | `VARCHAR`                |
| `number`         | 17                                          | `INT`                    |
| `email`          | [budi@example.com](mailto:budi@example.com) | `VARCHAR`                |
| `password`       | rahasia123                                  | `VARCHAR`                |
| `tel`            | 081234567890                                | `VARCHAR`                |
| `date`           | 2008-05-20                                  | `DATE`                   |
| `time`           | 07:00                                       | `TIME`                   |
| `datetime-local` | 2026-09-17 07:30                            | `DATETIME`               |
| `radio`          | L                                           | `CHAR` / `VARCHAR`       |
| `checkbox`       | Membaca                                     | `VARCHAR` / tabel relasi |
| `select`         | X RPL 1                                     | `VARCHAR` / `INT`        |
| `textarea`       | Alamat panjang                              | `TEXT`                   |
| `color`          | #ff0000                                     | `VARCHAR`                |
| `range`          | 80                                          | `INT`                    |
| `url`            | https://example.com                         | `VARCHAR`                |
| `search`         | Budi                                        | `VARCHAR`                |

---

# 4. Contoh Tabel Data Siswa

Berdasarkan contoh form Data Siswa:

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
    updated_at DATETIME NULL
);
```

## Penjelasan

| Kolom           | Tipe Data      | Fungsi            |
| --------------- | -------------- | ----------------- |
| `id`            | `INT`          | ID siswa          |
| `nis`           | `VARCHAR(20)`  | Nomor induk siswa |
| `nama`          | `VARCHAR(100)` | Nama lengkap      |
| `email`         | `VARCHAR(100)` | Email             |
| `no_hp`         | `VARCHAR(20)`  | Nomor HP          |
| `jenis_kelamin` | `CHAR(1)`      | L atau P          |
| `kelas`         | `VARCHAR(20)`  | Kelas siswa       |
| `alamat`        | `TEXT`         | Alamat            |
| `tanggal_lahir` | `DATE`         | Tanggal lahir     |
| `created_at`    | `DATETIME`     | Waktu data dibuat |
| `updated_at`    | `DATETIME`     | Waktu data diubah |

---

# 5. Hal Penting

### Nomor HP bukan INT

Jangan:

```sql
no_hp INT
```

Gunakan:

```sql
no_hp VARCHAR(20)
```

Karena:

```text
081234567890
```

adalah **identitas/teks**, bukan angka yang akan dijumlahkan.

---

### Harga bukan INT jika membutuhkan pecahan

Untuk nilai seperti:

```text
12500.50
```

gunakan:

```sql
harga DECIMAL(12,2)
```

---

### Tanggal menggunakan DATE

Gunakan:

```sql
tanggal_lahir DATE
```

bukan:

```sql
tanggal_lahir VARCHAR(20)
```

jika data tersebut memang merupakan tanggal yang akan dicari, dibandingkan, atau diurutkan berdasarkan tanggal.

---

# 6. Alur Data

Secara sederhana, data berjalan melalui beberapa tahap:

```text
HTML
  ↓
Form Input
  ↓
PHP
  ↓
Validasi
  ↓
MySQL
  ↓
Database
```

Contohnya:

```text
<input type="text">
        ↓
   $_POST['nama']
        ↓
      PHP
        ↓
VARCHAR(100)
        ↓
     MySQL
```

Jadi, **HTML menentukan bagaimana pengguna memasukkan data**, PHP memproses data tersebut, sedangkan **MySQL menentukan bagaimana data disimpan di database**.
