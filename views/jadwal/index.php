<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Jadwal</h3>
    <a href="<?= BASE_URL ?>jadwal/create" class="btn btn-primary">+ Tambah Jadwal</a>
</div>

<?php if (empty($data['jadwal'])): ?>
    <div class="alert alert-info">Belum ada data jadwal. Silakan tambah data baru.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Kode Jadwal</th>
                    <th>Nama Jadwal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['jadwal'] as $i => $g): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($g['kode_jadwal']) ?></td>
                        <td><?= htmlspecialchars($g['nama_jadwal']) ?></td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>jadwal/edit/<?= $g['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= BASE_URL ?>jadwal/delete/<?= $g['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data jadwal ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>