<h3>Tambah Data Kelas</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>kelas/store" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control" placeholder="Contoh: RPL" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control" placeholder="Contoh: X" required>
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