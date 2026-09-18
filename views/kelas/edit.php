<h3>Edit Data Kelas</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>kelas/update/<?= $data['kelas']['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control"
                    value="<?= htmlspecialchars($data['kelas']['nama_jurusan']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control"
                    value="<?= htmlspecialchars($data['kelas']['kelas']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Wali Kelas</label>
                <select name="wali_kelas_id" class="form-select">
                    <option value="">-- Pilih Wali Kelas (opsional) --</option>
                    <?php foreach ($data['daftar_guru'] as $g): ?>
                        <option value="<?= $g['id'] ?>"
                            <?= $g['id'] == $data['kelas']['wali_kelas_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($g['nama_guru']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASE_URL ?>kelas" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>