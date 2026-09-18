<div class="mb-4">
    <h3>Selamat Datang di <?= APP_NAME ?></h3>
    <p class="text-muted">Contoh aplikasi PHP Native + Bootstrap dengan routing sendiri, untuk belajar CRUD.</p>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Guru</h6>
                <p class="display-6 fw-bold text-primary"><?= $data['jumlah_guru'] ?></p>
                <a href="<?= BASE_URL ?>guru" class="btn btn-outline-primary btn-sm">Kelola Data Guru</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Siswa</h6>
                <p class="display-6 fw-bold text-success"><?= $data['jumlah_siswa'] ?></p>
                <a href="<?= BASE_URL ?>siswa" class="btn btn-outline-success btn-sm">Kelola Data Siswa</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Kelas</h6>
                <p class="display-6 fw-bold text-warning"><?= $data['jumlah_kelas'] ?></p>
                <a href="<?= BASE_URL ?>kelas" class="btn btn-outline-warning btn-sm">Kelola Data Kelas</a>
            </div>
        </div>
    </div>
</div>
