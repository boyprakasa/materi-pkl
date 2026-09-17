<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('ID siswa tidak ditemukan.');
}

$stmt = $pdo->prepare("
    SELECT *
    FROM siswa
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

$siswa = $stmt->fetch();

if (!$siswa) {
    die('Data siswa tidak ditemukan.');
}

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
                    value="<?= htmlspecialchars($siswa['nis']) ?>"
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
                    value="<?= htmlspecialchars($siswa['nama']) ?>"
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
                    value="<?= htmlspecialchars($siswa['email']) ?>">

            </div>

            <div class="form-group">

                <label for="no_hp">
                    No. HP
                </label>

                <input
                    type="tel"
                    id="no_hp"
                    name="no_hp"
                    value="<?= htmlspecialchars($siswa['no_hp']) ?>">

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
                        <?= $siswa['jenis_kelamin'] === 'L'
                            ? 'checked'
                            : ''
                        ?>
                        required>

                    Laki-laki
                </label>

                <label>
                    <input
                        type="radio"
                        name="jenis_kelamin"
                        value="P"
                        <?= $siswa['jenis_kelamin'] === 'P'
                            ? 'checked'
                            : ''
                        ?>>

                    Perempuan
                </label>

            </div>

            <div class="form-group">

                <label for="kelas">
                    Kelas
                </label>

                <select
                    id="kelas"
                    name="kelas"
                    required>

                    <option value="">
                        -- Pilih Kelas --
                    </option>

                    <option
                        value="X RPL 1"
                        <?= $siswa['kelas'] === 'X RPL 1'
                            ? 'selected'
                            : ''
                        ?>>
                        X RPL 1
                    </option>

                    <option
                        value="X RPL 2"
                        <?= $siswa['kelas'] === 'X RPL 2'
                            ? 'selected'
                            : ''
                        ?>>
                        X RPL 2
                    </option>

                    <option
                        value="XI RPL 1"
                        <?= $siswa['kelas'] === 'XI RPL 1'
                            ? 'selected'
                            : ''
                        ?>>
                        XI RPL 1
                    </option>

                    <option
                        value="XI RPL 2"
                        <?= $siswa['kelas'] === 'XI RPL 2'
                            ? 'selected'
                            : ''
                        ?>>
                        XI RPL 2
                    </option>

                    <option
                        value="XII RPL 1"
                        <?= $siswa['kelas'] === 'XII RPL 1'
                            ? 'selected'
                            : ''
                        ?>>
                        XII RPL 1
                    </option>

                    <option
                        value="XII RPL 2"
                        <?= $siswa['kelas'] === 'XII RPL 2'
                            ? 'selected'
                            : ''
                        ?>>
                        XII RPL 2
                    </option>

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
                    value="<?= htmlspecialchars($siswa['tanggal_lahir']) ?>">

            </div>

            <div class="form-group">

                <label for="alamat">
                    Alamat
                </label>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="4"><?= htmlspecialchars($siswa['alamat']) ?></textarea>

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