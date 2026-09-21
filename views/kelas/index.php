<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Kelas</h3>
    <a href="<?= BASE_URL ?>kelas/create" class="btn btn-primary">+ Tambah Kelas</a>
</div>

<?php if (empty($data['kelas'])): ?>
    <div class="alert alert-info">Belum ada data kelas. Silakan tambah data baru.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Jurusan</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['kelas'] as $i => $k): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($k['nama_jurusan']) ?></td>
                        <td><?= htmlspecialchars($k['kelas']) ?></td>
                        <td><?= $k['wali_kelas'] ? htmlspecialchars($k['wali_kelas']) : '<span class="text-muted">-</span>' ?></td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>kelas/edit/<?= $k['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= BASE_URL ?>kelas/delete/<?= $k['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data kelas ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-header">Jumlah Kelas: <?= count($data['kelas']) ?></div>
        <div class="card-body">
            <pre class="bg-dark text-light p-3 rounded">
                <code><?= preg_replace('/\[\d+\]\s*=>\s*/', '', print_r($data['kelas'], true)) ?></code>
            </pre>
        </div>
    </div>
<?php endif; ?>