<h3>Tambah Data Kelas</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>kelas/store" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: VII-A" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tingkat</label>
                <input type="text" name="tingkat" class="form-control" placeholder="Contoh: 7" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Wali Kelas</label>
                <select name="wali_kelas_id" class="form-select">
                    <option value="">-- Pilih Wali Kelas (opsional) --</option>
                    <?php foreach ($data['daftar_guru'] as $g): ?>
                        <option value="<?= $g['id'] ?>"><?= htmlspecialchars($g['nama_guru']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL ?>kelas" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
