<h3>Edit Data Tahun Ajaran</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>tahun-ajaran/update/<?= $data['tahun_ajaran']['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Tahun Ajaran</label>
                <input type="text" name="nama_tahun_ajaran" class="form-control" required value="<?= $data['tahun_ajaran']['nama_tahun_ajaran'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Semester</label><br>
                <input type="radio" name="semester" value="Ganjil" <?= $data['tahun_ajaran']['semester'] === 'Ganjil' ? 'checked' : '' ?>>Ganjil
                <input type="radio" name="semester" value="Genap" <?= $data['tahun_ajaran']['semester'] === 'Genap' ? 'checked' : '' ?>>Genap
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label><br>
                <input type="radio" name="status" value="Aktif" <?= $data['tahun_ajaran']['status'] === 'Aktif' ? 'checked' : '' ?>>Aktif
                <input type="radio" name="status" value="Tidak Aktif" <?= $data['tahun_ajaran']['status'] === 'Tidak Aktif' ? 'checked' : '' ?>>Tidak Aktif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASE_URL ?>tahun-ajaran" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>