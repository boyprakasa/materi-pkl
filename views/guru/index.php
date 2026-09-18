<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Guru</h3>
    <a href="<?= BASE_URL ?>guru/create" class="btn btn-primary">+ Tambah Guru</a>
</div>

<?php if (empty($data['guru'])): ?>
    <div class="alert alert-info">Belum ada data guru. Silakan tambah data baru.</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped bg-white align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama Guru</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['guru'] as $i => $g): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($g['nip']) ?></td>
                <td><?= htmlspecialchars($g['nama_guru']) ?></td>
                <td><?= htmlspecialchars($g['jenis_kelamin']) ?></td>
                <td><?= htmlspecialchars($g['alamat']) ?></td>
                <td><?= htmlspecialchars($g['no_hp']) ?></td>
                <td class="text-center">
                    <a href="<?= BASE_URL ?>guru/edit/<?= $g['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= BASE_URL ?>guru/delete/<?= $g['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Yakin ingin menghapus data guru ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
