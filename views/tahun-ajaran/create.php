<h3>Tambah Data Tahun Ajaran</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>tahun-ajaran/store" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Tahun Ajaran</label>
                <input type="text" name="nama_tahun_ajaran" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Semester</label><br>
                <input type="radio" class="radio-control" name="semester" value="Ganjil">Ganjil
                <input type="radio" class="radio-control" name="semester" value="Genap">Genap
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label><br>
                <input type="radio" class="radio-control" name="status" value="Aktif">Aktif
                <input type="radio" class="radio-control" name="status" value="Tidak Aktif">Tidak Aktif
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL ?>tahun-ajaran" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>