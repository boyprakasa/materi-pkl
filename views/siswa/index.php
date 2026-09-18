<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Siswa</h3>
    <a href="<?= BASE_URL ?>siswa/create" class="btn btn-primary">+ Tambah Siswa</a>
</div>

<?php if (empty($data['siswa'])): ?>
    <div class="alert alert-info">Belum ada data siswa. Silakan tambah data baru.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Kelas</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['siswa'] as $i => $s): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($s['nis']) ?></td>
                        <td><?= htmlspecialchars($s['nama_siswa']) ?></td>
                        <td><?= htmlspecialchars($s['jenis_kelamin']) ?></td>
                        <td><?= htmlspecialchars($s['tanggal_lahir']) ?></td>
                        <td><?= htmlspecialchars($s['alamat']) ?></td>
                        <td><?= $s['nama_kelas'] ? htmlspecialchars($s['nama_kelas'] . ' - ' . $s['nama_jurusan']) : '<span class="text-muted">-</span>' ?></td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>siswa/edit/<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= BASE_URL ?>siswa/delete/<?= $s['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data siswa ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>