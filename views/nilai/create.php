<h3>Tambah Data Nilai</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>nilai/store" method="POST">
            <div class="mb-3">
                <label class="form-label">Siswa</label>
                <select class="form-select" name="siswa_id">
                    <option value="">Pilih Siswa</option>
                    <?php foreach ($data['daftar_siswa'] as $siswa): ?>
                        <option value="<?= $siswa['id'] ?>"><?= $siswa['nama_siswa'] ?> - <?= $siswa['kelas_id'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Mata Pelajaran</label>
                <select class="form-select" name="mapel_id">
                    <option value="">Pilih Mata Pelajaran</option>
                    <?php foreach ($data['daftar_mapel'] as $mapel): ?>
                        <option value="<?= $mapel['id'] ?>"><?= $mapel['nama_mapel'] ?> - <?= $mapel['kode_mapel'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Nilai</label>
                <select class="form-select" name="jenis_nilai">
                    <option value="">Pilih Jenis Nilai</option>
                    <option value="Tugas">Tugas</option>
                    <option value="UTS">UTS</option>
                    <option value="UAS">UAS</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nilai</label>
                <input type="number" min="0" max="100" name="nilai" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL ?>nilai" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>