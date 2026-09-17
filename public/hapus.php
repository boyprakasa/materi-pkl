<?php

require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('ID siswa tidak ditemukan.');
}

$stmt = $pdo->prepare("
    DELETE FROM siswa
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

header('Location: index.php');

exit;
