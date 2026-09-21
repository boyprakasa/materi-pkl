<h3>Edit Data Jadwal</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>jadwal/update/<?= $data['jadwal']['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Kode Jadwal</label>
                <input type="text" name="kode_jadwal" class="form-control"
                    value="<?= htmlspecialchars($data['jadwal']['kode_jadwal']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Jadwal</label>
                <input type="text" name="nama_jadwal" class="form-control"
                    value="<?= htmlspecialchars($data['jadwal']['nama_jadwal']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASE_URL ?>jadwal" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>