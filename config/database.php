<?php

/**
 * config/database.php
 * Membuat koneksi ke database MySQL menggunakan PDO.
 * Variabel $pdo di sini akan dipakai di semua Model (lewat "global $pdo").
 *
 * Sesuaikan DB_HOST, DB_NAME, DB_USER, DB_PASS dengan pengaturan
 * MySQL/XAMPP/Laragon di komputer kamu.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$database = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);

    // Supaya error langsung terlihat jelas (bagus untuk proses belajar)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage() .
        "<br>Pastikan database telah sudah dibuat.");
}
