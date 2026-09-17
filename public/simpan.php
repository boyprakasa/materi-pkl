<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    http_response_code(405);

    $_SESSION['error'] = 'Method request tidak diizinkan.';

    header('Location: index.php');
    exit;
}

$nis = trim($_POST['nis'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$kelas = $_POST['kelas'] ?? '';
$tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
$alamat = trim($_POST['alamat'] ?? '');

$errors = [];

// NIS
if ($nis === '') {
    $errors[] = 'NIS wajib diisi.';
} elseif (!preg_match('/^[0-9]+$/', $nis)) {
    $errors[] = 'NIS hanya boleh berisi angka.';
} elseif (strlen($nis) > 20) {
    $errors[] = 'NIS maksimal 20 angka.';
}

// Nama
if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
} elseif (strlen($nama) > 100) {
    $errors[] = 'Nama maksimal 100 karakter.';
}

// Email
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}

// No HP
if ($no_hp !== '' && strlen($no_hp) > 20) {
    $errors[] = 'No. HP maksimal 20 karakter.';
}

// Jenis kelamin
if (!in_array($jenis_kelamin, ['L', 'P'], true)) {
    $errors[] = 'Jenis kelamin tidak valid.';
}

// Kelas
$kelasValid = [
    'X RPL 1',
    'X RPL 2',
    'XI RPL 1',
    'XI RPL 2',
    'XII RPL 1',
    'XII RPL 2',
];

if (!in_array($kelas, $kelasValid, true)) {
    $errors[] = 'Kelas tidak valid.';
}

// Validasi gagal
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

    header('Location: index.php', true, 302);
    exit;
}

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
            tanggal_lahir,
            alamat
        )
        VALUES (
            :nis,
            :nama,
            :email,
            :no_hp,
            :jenis_kelamin,
            :kelas,
            :tanggal_lahir,
            :alamat
        )
    ");

    $stmt->execute([
        'nis' => $nis,
        'nama' => $nama,
        'email' => $email !== '' ? $email : null,
        'no_hp' => $no_hp !== '' ? $no_hp : null,
        'jenis_kelamin' => $jenis_kelamin,
        'kelas' => $kelas,
        'tanggal_lahir' => $tanggal_lahir !== '' ? $tanggal_lahir : null,
        'alamat' => $alamat !== '' ? $alamat : null,
    ]);

    $pdo->commit();

    $_SESSION['success'] = 'Data siswa berhasil disimpan.';
} catch (PDOException $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    if ($e->getCode() === '23000') {

        http_response_code(409);

        $_SESSION['error'] = 'NIS sudah digunakan.';
    } else {

        http_response_code(500);

        $_SESSION['error'] = 'Data siswa gagal disimpan.';
    }
}

header('Location: index.php');
exit;
