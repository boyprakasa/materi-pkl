<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Nilai</h3>
    <a href="<?= BASE_URL ?>nilai/create" class="btn btn-primary">+ Tambah Nilai</a>
</div>

<?php if (empty($data['nilai'])): ?>
    <div class="alert alert-info">Belum ada data nilai. Silakan tambah data baru.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Siswa</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Jenis Nilai</th>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['nilai'] as $i => $g): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $g['nama_siswa'] ?></td>
                        <td><?= $g['kelas'] . ' - ' . $g['nama_jurusan'] ?></td>
                        <td><?= "[" . $g['kode_mapel'] . "] " . $g['nama_mapel'] ?></td>
                        <td><?= $g['jenis_nilai'] ?></td>
                        <td><?= $g['nilai'] ?></td>
                        <td><?= $g['keterangan'] ?></td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>nilai/edit/<?= $g['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= BASE_URL ?>nilai/delete/<?= $g['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data nilai ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-header">Jumlah Data: <?= count($data['nilai']) ?></div>
        <div class="card-body">
            <pre class="bg-dark text-light p-3 rounded">
                <code><?= preg_replace('/\[\d+\]\s*=>\s*/', '', print_r($data['nilai'], true)) ?></code>
            </pre>
        </div>
    </div>
<?php endif; ?>