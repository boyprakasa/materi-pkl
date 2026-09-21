<h3>Edit Data Nilai</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>nilai/update/<?= $data['nilai']['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Siswa</label>
                <select class="form-select" name="siswa_id">
                    <option value="">Pilih Siswa</option>
                    <?php foreach ($data['daftar_siswa'] as $siswa): ?>
                        <option <?= $siswa['id'] == $data['nilai']['siswa_id'] ? 'selected' : '' ?> value="<?= $siswa['id'] ?>"><?= $siswa['nama_kelas'] . ' ' . $siswa['nama_jurusan'] . ' - ' . $siswa['nama_siswa'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Mata Pelajaran</label>
                <select class="form-select" name="mapel_id" required>
                    <option value="">Pilih Mata Pelajaran</option>
                    <?php foreach ($data['daftar_mapel'] as $mapel): ?>
                        <option <?= $mapel['id'] == $data['nilai']['mapel_id'] ? 'selected' : '' ?> value="<?= $mapel['id'] ?>"><?= $mapel['nama_mapel'] ?> - <?= $mapel['kode_mapel'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Nilai</label>
                <select class="form-select" name="jenis_nilai">
                    <option value="">Pilih Jenis Nilai</option>
                    <option <?= $data['nilai']['jenis_nilai'] == 'Tugas' ? 'selected' : '' ?> value="Tugas">Tugas</option>
                    <option <?= $data['nilai']['jenis_nilai'] == 'UTS' ? 'selected' : '' ?> value="UTS">UTS</option>
                    <option <?= $data['nilai']['jenis_nilai'] == 'UAS' ? 'selected' : '' ?> value="UAS">UAS</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nilai</label>
                <input type="number" min="0" max="100" name="nilai" class="form-control" value="<?= $data['nilai']['nilai'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control"><?= $data['nilai']['keterangan'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASE_URL ?>nilai" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>