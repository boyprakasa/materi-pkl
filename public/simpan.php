<?php

require_once __DIR__ . '/../config/database.php';

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$kelas = $_POST['kelas'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];

$sql = "
    INSERT INTO siswa (
        nis,
        nama,
        email,
        no_hp,
        jenis_kelamin,
        kelas,
        tanggal_lahir,
        alamat,
        created_at,
        updated_at
    )
    VALUES (
        :nis,
        :nama,
        :email,
        :no_hp,
        :jenis_kelamin,
        :kelas,
        :tanggal_lahir,
        :alamat,
        :created_at,
        :updated_at
    )
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nis' => $nis,
    ':nama' => $nama,
    ':email' => $email,
    ':no_hp' => $no_hp,
    ':jenis_kelamin' => $jenis_kelamin,
    ':kelas' => $kelas,
    ':tanggal_lahir' => $tanggal_lahir,
    ':alamat' => $alamat,
    ':created_at' => date('Y-m-d H:i:s'),
    ':updated_at' => date('Y-m-d H:i:s')
]);

header('Location: index.php');

exit;
