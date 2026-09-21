<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Absensi</h3>
    <a href="<?= BASE_URL ?>absensi/create" class="btn btn-primary">+ Tambah Absensi</a>
</div>

<?php if (empty($data['absensi'])): ?>
    <div class="alert alert-info">Belum ada data absensi. Silakan tambah data baru.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Siswa</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['absensi'] as $i => $g): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $g['tanggal'] ?></td>
                        <td><?= $g['siswa_id'] ?></td>
                        <td><?= $g['status'] ?></td>
                        <td><?= $g['keterangan'] ?></td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>absensi/edit/<?= $g['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= BASE_URL ?>absensi/delete/<?= $g['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data absensi ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>