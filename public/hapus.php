<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {

    http_response_code(404);

    $_SESSION['error'] = 'ID siswa tidak valid.';

    header('Location: index.php');
    exit;
}

try {

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        DELETE FROM siswa
        WHERE id = :id
    ");

    $stmt->execute([
        'id' => $id,
    ]);

    if ($stmt->rowCount() === 0) {
        throw new RuntimeException('Data siswa tidak ditemukan.');
    }

    $pdo->commit();

    $_SESSION['success'] = 'Data siswa berhasil dihapus.';
} catch (PDOException $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    http_response_code(500);

    $_SESSION['error'] = 'Data siswa gagal dihapus.';
} catch (RuntimeException $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    http_response_code(404);

    $_SESSION['error'] = $e->getMessage();
}

header('Location: index.php');
exit;
