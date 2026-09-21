<h3>Edit Data Jadwal</h3>
<!-- <pre>
    <?= print_r($data) ?>
    <?= print_r($data['daftar_kelas']) ?>
    <?= print_r($data['daftar_mapel']) ?>
    <?= print_r($data['daftar_guru']) ?>
</pre> -->
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>jadwal/update/<?= $data['jadwal']['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select class="form-select" name="kelas_id">
                    <option value="">Pilih Kelas</option>
                    <?php foreach ($data['daftar_kelas'] as $kelas): ?>
                        <option <?= $kelas['id'] === $data['jadwal']['kelas_id'] ? 'selected' : '' ?> value="<?= $kelas['id'] ?>"><?= $kelas['nama_jurusan'] ?> - <?= $kelas['kelas'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Mata Pelajaran</label>
                <select class="form-select" name="mapel_id">
                    <option value="">Pilih Mata Pelajaran</option>
                    <?php foreach ($data['daftar_mapel'] as $mapel): ?>
                        <option <?= $mapel['id'] === $data['jadwal']['mapel_id'] ? 'selected' : '' ?> value="<?= $mapel['id'] ?>"><?= $mapel['nama_mapel'] ?> - <?= $mapel['kode_mapel'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Guru</label>
                <select class="form-select" name="guru_id">
                    <option value="">Pilih Guru</option>
                    <?php foreach ($data['daftar_guru'] as $guru): ?>
                        <option <?= $guru['id'] === $data['jadwal']['guru_id'] ? 'selected' : '' ?> value="<?= $guru['id'] ?>"><?= $guru['nama_guru'] ?> - <?= $guru['nip'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" value="<?= $data['jadwal']['jam_mulai'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" value="<?= $data['jadwal']['jam_selesai'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hari</label>
                <select class="form-select" name="hari" required>
                    <option value="">Pilih Hari</option>
                    <option <?= $data['jadwal']['hari'] === 'Senin' ? 'selected' : '' ?> value="Senin">Senin</option>
                    <option <?= $data['jadwal']['hari'] === 'Selasa' ? 'selected' : '' ?> value="Selasa">Selasa</option>
                    <option <?= $data['jadwal']['hari'] === 'Rabu' ? 'selected' : '' ?> value="Rabu">Rabu</option>
                    <option <?= $data['jadwal']['hari'] === 'Kamis' ? 'selected' : '' ?> value="Kamis">Kamis</option>
                    <option <?= $data['jadwal']['hari'] === 'Jumat' ? 'selected' : '' ?> value="Jumat">Jumat</option>
                    <option value="Sabtu" disabled>Sabtu</option>
                    <option value="Minggu" disabled>Minggu</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASE_URL ?>jadwal" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>