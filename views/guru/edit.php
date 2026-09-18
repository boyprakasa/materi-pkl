<h3>Edit Data Guru</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>guru/update/<?= $data['guru']['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control"
                       value="<?= htmlspecialchars($data['guru']['nip']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Guru</label>
                <input type="text" name="nama_guru" class="form-control"
                       value="<?= htmlspecialchars($data['guru']['nama_guru']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="Laki-laki" <?= $data['guru']['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $data['guru']['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"><?= htmlspecialchars($data['guru']['alamat']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-control"
                       value="<?= htmlspecialchars($data['guru']['no_hp']) ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASE_URL ?>guru" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
