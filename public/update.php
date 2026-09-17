<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = 'Metode request tidak diizinkan.';
    header('Location: index.php', true, 302);
    exit;
}

/*
|--------------------------------------------------------------------------
| Ambil Data
|--------------------------------------------------------------------------
*/

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

$nis            = trim($_POST['nis'] ?? '');
$nama           = trim($_POST['nama'] ?? '');
$email          = trim($_POST['email'] ?? '');
$no_hp          = trim($_POST['no_hp'] ?? '');
$jenis_kelamin  = $_POST['jenis_kelamin'] ?? '';
$kelas          = $_POST['kelas'] ?? '';
$tanggal_lahir  = $_POST['tanggal_lahir'] ?? '';
$alamat         = trim($_POST['alamat'] ?? '');

/*
|--------------------------------------------------------------------------
| Validasi
|--------------------------------------------------------------------------
*/

$errors = [];

if (!$id) {
    $errors[] = 'ID siswa tidak valid.';
}

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

if ($tanggal_lahir !== '') {
    $date = DateTime::createFromFormat('Y-m-d', $tanggal_lahir);

    if (!$date || $date->format('Y-m-d') !== $tanggal_lahir) {
        $errors[] = 'Tanggal lahir tidak valid.';
    }
}

/*
|--------------------------------------------------------------------------
| Jika Validasi Gagal
|--------------------------------------------------------------------------
*/

if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);

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

    header(
        'Location: edit.php?id=' . urlencode((string) $id),
        true,
        302
    );

    exit;
}

/*
|--------------------------------------------------------------------------
| Update Database
|--------------------------------------------------------------------------
*/

try {
    $pdo->beginTransaction();

    /*
    |--------------------------------------------------------------------------
    | Pastikan Data Siswa Masih Ada
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | Cek NIS Duplikat
    |--------------------------------------------------------------------------
    |
    | NIS boleh sama dengan data yang sedang diedit,
    | tetapi tidak boleh sama dengan siswa lain.
    |
    */

    $stmt = $pdo->prepare("
        SELECT id
        FROM siswa
        WHERE nis = ?
          AND id != ?
        LIMIT 1
    ");

    $stmt->execute([$nis, $id]);

    if ($stmt->fetch()) {
        throw new RuntimeException('NIS sudah digunakan oleh siswa lain.');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

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

    $_SESSION['success'] = 'Data siswa berhasil diperbarui.';

    header('Location: index.php', true, 302);
    exit;
} catch (RuntimeException $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['error'] = $e->getMessage();

    header(
        'Location: edit.php?id=' . urlencode((string) $id),
        true,
        302
    );

    exit;
} catch (PDOException $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['error'] = 'Terjadi kesalahan database. Data tidak dapat diperbarui.';

    header('Location: edit.php?id=' . urlencode((string) $id), true, 302);
    exit;
}
