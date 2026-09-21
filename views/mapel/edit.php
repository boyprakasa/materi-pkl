<h3>Edit Data Mapel</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>mapel/update/<?= $data['mapel']['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Kode Mapel</label>
                <input type="text" name="kode_mapel" class="form-control"
                    value="<?= htmlspecialchars($data['mapel']['kode_mapel']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mapel</label>
                <input type="text" name="nama_mapel" class="form-control"
                    value="<?= htmlspecialchars($data['mapel']['nama_mapel']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASE_URL ?>mapel" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>