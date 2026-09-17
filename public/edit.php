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

    $stmt = $pdo->prepare("
        SELECT *
        FROM siswa
        WHERE id = :id
    ");

    $stmt->execute([
        'id' => $id,
    ]);

    $siswa = $stmt->fetch();

    if (!$siswa) {

        http_response_code(404);

        $_SESSION['error'] = 'Data siswa tidak ditemukan.';

        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {

    http_response_code(500);

    $_SESSION['error'] = 'Gagal mengambil data siswa.';

    header('Location: index.php');
    exit;
}

$old = $_SESSION['old'] ?? [];

unset($_SESSION['old']);

$kelasOptions = [
    'X RPL 1',
    'X RPL 2',
    'XI RPL 1',
    'XI RPL 2',
    'XII RPL 1',
    'XII RPL 2',
];

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Edit Siswa</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">

        <?php if (isset($_SESSION['error'])): ?>

            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>

            <?php unset($_SESSION['error']); ?>

        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>

            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>

            <?php unset($_SESSION['success']); ?>

        <?php endif; ?>

        <h1>Edit Data Siswa</h1>

        <form action="update.php" method="POST">

            <input
                type="hidden"
                name="id"
                value="<?= $siswa['id'] ?>">

            <div class="form-group">

                <label for="nis">
                    NIS
                </label>

                <input
                    type="text"
                    id="nis"
                    name="nis"
                    value="<?= htmlspecialchars($old['nis'] ?? $siswa['nis']) ?>"
                    required>

            </div>

            <div class="form-group">

                <label for="nama">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="<?= htmlspecialchars($old['nama'] ?? $siswa['nama']) ?>"
                    required>

            </div>

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($old['email'] ?? $siswa['email']) ?>">

            </div>

            <div class="form-group">

                <label for="no_hp">
                    No. HP
                </label>

                <input
                    type="tel"
                    id="no_hp"
                    name="no_hp"
                    value="<?= htmlspecialchars($old['no_hp'] ?? $siswa['no_hp']) ?>">

            </div>

            <div class="form-group">

                <label>
                    Jenis Kelamin
                </label>

                <label>
                    <input
                        type="radio"
                        name="jenis_kelamin"
                        value="L"
                        <?= (($old['jenis_kelamin'] ?? $siswa['jenis_kelamin']) === 'L') ? 'checked' : '' ?>
                        required>

                    Laki-laki
                </label>

                <label>
                    <input
                        type="radio"
                        name="jenis_kelamin"
                        value="P"
                        <?= (($old['jenis_kelamin'] ?? $siswa['jenis_kelamin']) === 'L') ? 'checked' : '' ?>>

                    Perempuan
                </label>

            </div>

            <div class="form-group">

                <label for="kelas">
                    Kelas
                </label>

                <select id="kelas" name="kelas" required>

                    <option value="">-- Pilih Kelas --</option>

                    <?php foreach ($kelasOptions as $kelas): ?>

                        <option
                            value="<?= htmlspecialchars($kelas) ?>"
                            <?= (($old['kelas'] ?? $siswa['kelas']) === $kelas) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kelas) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label for="tanggal_lahir">
                    Tanggal Lahir
                </label>

                <input
                    type="date"
                    id="tanggal_lahir"
                    name="tanggal_lahir"
                    value="<?= htmlspecialchars($old['tanggal_lahir'] ?? $siswa['tanggal_lahir'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label for="alamat">
                    Alamat
                </label>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="4"><?= htmlspecialchars($old['alamat'] ?? $siswa['alamat'] ?? '') ?></textarea>

            </div>

            <button type="submit">
                Update
            </button>

            <a href="index.php">
                Batal
            </a>

        </form>

    </div>

</body>

</html>