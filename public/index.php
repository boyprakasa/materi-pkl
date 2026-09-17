<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/database.php';

http_response_code(200);

try {

    $stmt = $pdo->query("
        SELECT *
        FROM siswa
        ORDER BY id DESC
    ");

    $siswa = $stmt->fetchAll();
} catch (PDOException $e) {

    http_response_code(500);

    $_SESSION['error'] = 'Gagal mengambil data siswa.';

    $siswa = [];
}

$old = $_SESSION['old'] ?? [];

unset($_SESSION['old']);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Siswa</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.min.css">

    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
</head>

<body>

    <div class="container">

        <?php if (isset($_SESSION['success'])): ?>

            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>

            <?php unset($_SESSION['success']); ?>

        <?php endif; ?>


        <?php if (isset($_SESSION['error'])): ?>

            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>

            <?php unset($_SESSION['error']); ?>

        <?php endif; ?>

        <h1>Data Siswa</h1>

        <form action="simpan.php" method="POST">

            <div class="form-group">
                <label for="nis">NIS</label>

                <div class="language-html">
                    <code class="language-html">&lt;input type="text" id="nis" name="nis" required&gt;</code>
                </div>

                <input type="text" id="nis" name="nis" value="<?= $old['nis'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>

                <div class="language-html">
                    <code class="language-html">&lt;input type="text" id="nama" name="nama" required&gt;</code>
                </div>

                <input type="text" id="nama" name="nama" value="<?= $old['nama'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>

                <div class="language-html">
                    <code class="language-html">&lt;input type="email" id="email" name="email"&gt;</code>
                </div>

                <input type="email" id="email" name="email" value="<?= $old['email'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label for="no_hp">No. HP</label>

                <div class="language-html">
                    <code class="language-html">&lt;input type="tel" id="no_hp" name="no_hp"&gt;</code>
                </div>

                <input type="tel" id="no_hp" name="no_hp" value="<?= $old['no_hp'] ?? '' ?>">
            </div>

            <div class="form-group">

                <label>Jenis Kelamin</label>

                <div class="language-html">
                    <code class="language-html">
                        &lt;input type="radio" name="jenis_kelamin" value="L"&gt;
                    </code>
                </div>

                <label>
                    <input type="radio" name="jenis_kelamin" value="L" required <?= (($old['jenis_kelamin'] ?? '') === 'L') ? 'checked' : '' ?>>
                    Laki-laki
                </label>

                <label>
                    <input type="radio" name="jenis_kelamin" value="P" <?= (($old['jenis_kelamin'] ?? '') === 'P') ? 'checked' : '' ?>>
                    Perempuan
                </label>

            </div>

            <div class="form-group">

                <label for="kelas">Kelas</label>

                <div class="language-html">
                    <code class="language-html">
                        &lt;select id="kelas" name="kelas" required&gt;
                    </code>
                </div>

                <select id="kelas" name="kelas" required>
                    <option value="">-- Pilih Kelas --</option>

                    <?php
                    $kelasOptions = [
                        'X RPL 1',
                        'X RPL 2',
                        'XI RPL 1',
                        'XI RPL 2',
                        'XII RPL 1',
                        'XII RPL 2',
                    ];
                    ?>

                    <?php foreach ($kelasOptions as $kelas): ?>
                        <option
                            value="<?= htmlspecialchars($kelas) ?>"
                            <?= (($old['kelas'] ?? '') === $kelas) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kelas) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div class="form-group">

                <label for="tanggal_lahir">
                    Tanggal Lahir
                </label>

                <div class="language-html">
                    <code class="language-html">
                        &lt;input type="date" id="tanggal_lahir" name="tanggal_lahir"&gt;
                    </code>
                </div>

                <input
                    type="date"
                    id="tanggal_lahir"
                    name="tanggal_lahir"
                    value="<?= htmlspecialchars($old['tanggal_lahir'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label for="alamat">
                    Alamat
                </label>

                <div class="language-html">
                    <code class="language-html">
                        &lt;textarea id="alamat" name="alamat" rows="4"&gt;&lt;/textarea&gt;
                    </code>
                </div>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="4"><?= htmlspecialchars($old['alamat'] ?? '') ?></textarea>

            </div>

            <button type="submit">
                Simpan
            </button>

        </form>


        <hr>


        <h2>Data Siswa</h2>

        <table>

            <thead>

                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Tanggal Lahir</th>
                    <th>Dibuat</th>
                    <th>Diubah</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($siswa as $index => $row): ?>

                    <tr>

                        <td>
                            <?= $index + 1 ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['nis']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['nama']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['email']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['no_hp']) ?>
                        </td>

                        <td>
                            <?= $row['jenis_kelamin'] === 'L'
                                ? 'Laki-laki'
                                : 'Perempuan'
                            ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['kelas']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['tanggal_lahir']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['created_at'] ?? '-') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['updated_at'] ?? '-') ?>
                        </td>

                        <td>

                            <a href="edit.php?id=<?= $row['id'] ?>">
                                Edit
                            </a>

                            <a
                                href="hapus.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Hapus
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</body>

</html>