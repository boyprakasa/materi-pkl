<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Tahun Ajaran</h3>
    <a href="<?= BASE_URL ?>tahun-ajaran/create" class="btn btn-primary">+ Tambah Tahun Ajaran</a>
</div>

<?php if (empty($data['tahun_ajaran'])): ?>
    <div class="alert alert-info">Belum ada data tahun ajaran. Silakan tambah data baru.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['tahun_ajaran'] as $i => $g): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $g['nama_tahun_ajaran'] ?></td>
                        <td><?= $g['semester'] ?></td>
                        <td><?= $g['status'] ?></td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>tahun-ajaran/edit/<?= $g['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= BASE_URL ?>tahun-ajaran/delete/<?= $g['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data tahun ajaran ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>