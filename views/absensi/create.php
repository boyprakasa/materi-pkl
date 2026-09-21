<h3>Tambah Data Absensi</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>absensi/store" method="POST">
            <div class="mb-3">
                <label class="form-label">Siswa</label>
                <select class="form-select" name="siswa_id">
                    <option value="">Pilih Siswa</option>
                    <?php foreach ($data['daftar_siswa'] as $siswa): ?>
                        <option value="<?= $siswa['id'] ?>"><?= $siswa['nama_kelas'] . ' ' . $siswa['nama_jurusan'] . ' - ' . $siswa['nama_siswa'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Pilih Status</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Alpa">Alpa</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL ?>absensi" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>