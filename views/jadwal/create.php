<h3>Tambah Data Jadwal</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>jadwal/store" method="POST">
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select class="form-select" name="kelas_id">
                    <option value="">Pilih Kelas</option>
                    <?php foreach ($data['daftar_kelas'] as $kelas): ?>
                        <option value="<?= $kelas['id'] ?>"><?= $kelas['nama_jurusan'] ?> - <?= $kelas['kelas'] ?></option>
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
                <label class="form-label">Guru</label>
                <select class="form-select" name="guru_id">
                    <option value="">Pilih Guru</option>
                    <?php foreach ($data['daftar_guru'] as $guru): ?>
                        <option value="<?= $guru['id'] ?>"><?= $guru['nama_guru'] ?> - <?= $guru['nip'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hari</label>
                <select class="form-select" name="hari">
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu" disabled>Sabtu</option>
                    <option value="Minggu" disabled>Minggu</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL ?>jadwal" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>