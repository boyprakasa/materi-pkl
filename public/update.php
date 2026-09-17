<?php

require_once __DIR__ . '/../config/database.php';

$id = $_POST['id'];

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$kelas = $_POST['kelas'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];

$sql = "
    UPDATE siswa
    SET
        nis = :nis,
        nama = :nama,
        email = :email,
        no_hp = :no_hp,
        jenis_kelamin = :jenis_kelamin,
        kelas = :kelas,
        tanggal_lahir = :tanggal_lahir,
        alamat = :alamat,
        updated_at = NOW()
    WHERE id = :id
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id,
    ':nis' => $nis,
    ':nama' => $nama,
    ':email' => $email,
    ':no_hp' => $no_hp,
    ':jenis_kelamin' => $jenis_kelamin,
    ':kelas' => $kelas,
    ':tanggal_lahir' => $tanggal_lahir,
    ':alamat' => $alamat,
]);

header('Location: index.php');

exit;
