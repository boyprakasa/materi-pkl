<h3>Edit Data Siswa</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>siswa/update/<?= $data['siswa']['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control"
                       value="<?= htmlspecialchars($data['siswa']['nis']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="form-control"
                       value="<?= htmlspecialchars($data['siswa']['nama_siswa']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="Laki-laki" <?= $data['siswa']['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $data['siswa']['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control"
                       value="<?= htmlspecialchars($data['siswa']['tanggal_lahir']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"><?= htmlspecialchars($data['siswa']['alamat']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="kelas_id" class="form-select">
                    <option value="">-- Pilih Kelas (opsional) --</option>
                    <?php foreach ($data['daftar_kelas'] as $k): ?>
                        <option value="<?= $k['id'] ?>"
                            <?= $k['id'] == $data['siswa']['kelas_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($k['nama_kelas']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASE_URL ?>siswa" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
