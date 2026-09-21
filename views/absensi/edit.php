<h3>Edit Data Mapel</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>absensi/update/<?= $data['absensi']['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Siswa</label>
                <select class="form-select" name="siswa_id">
                    <option value="">Pilih Siswa</option>
                    <?php foreach ($data['daftar_siswa'] as $siswa): ?>
                        <option <?= $siswa['id'] == $data['absensi']['siswa_id'] ? 'selected' : '' ?> value="<?= $siswa['id'] ?>"><?= $siswa['nama_kelas'] . ' ' . $siswa['nama_jurusan'] . ' - ' . $siswa['nama_siswa'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= $data['absensi']['tanggal'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option <?= $data['absensi']['status'] == '' ? 'selected' : '' ?> value="">Pilih Status</option>
                    <option <?= $data['absensi']['status'] == 'Hadir' ? 'selected' : '' ?> value="Hadir">Hadir</option>
                    <option <?= $data['absensi']['status'] == 'Izin' ? 'selected' : '' ?> value="Izin">Izin</option>
                    <option <?= $data['absensi']['status'] == 'Sakit' ? 'selected' : '' ?> value="Sakit">Sakit</option>
                    <option <?= $data['absensi']['status'] == 'Alpa' ? 'selected' : '' ?> value="Alpa">Alpa</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control"><?= $data['absensi']['keterangan'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASE_URL ?>absensi" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>