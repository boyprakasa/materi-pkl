<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Mapel</h3>
    <a href="<?= BASE_URL ?>mapel/create" class="btn btn-primary">+ Tambah Mapel</a>
</div>

<?php if (empty($data['mapel'])): ?>
    <div class="alert alert-info">Belum ada data mapel. Silakan tambah data baru.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Kode Mapel</th>
                    <th>Nama Mapel</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['mapel'] as $i => $g): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($g['kode_mapel']) ?></td>
                        <td><?= htmlspecialchars($g['nama_mapel']) ?></td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>mapel/edit/<?= $g['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= BASE_URL ?>mapel/delete/<?= $g['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data mapel ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>