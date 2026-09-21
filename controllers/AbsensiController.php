<?php
require_once __DIR__ . '/../models/Absensi.php';
require_once __DIR__ . '/../models/Siswa.php';

class AbsensiController
{
    private Absensi $absensiModel;
    private Siswa $siswaModel;

    public function __construct()
    {
        $this->absensiModel = new Absensi();
        $this->siswaModel = new Siswa();
    }

    /** GET /absensi — tampilkan semua data absensi */
    public function index()
    {
        $data['title'] = 'Data Absensi';
        $data['absensi']  = $this->absensiModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/absensi/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** GET /absensi/create — tampilkan form tambah absensi */
    public function create()
    {
        $data['title'] = 'Tambah Absensi';

        $data['daftar_siswa']  = $this->siswaModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/absensi/create.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /absensi/store — simpan data absensi baru */
    public function store()
    {
        $this->absensiModel->create($_POST);
        header('Location: ' . BASE_URL . 'absensi');
        exit;
    }

    /** GET /absensi/edit/{id} — tampilkan form edit absensi */
    public function edit($id)
    {
        $data['title'] = 'Edit Absensi';

        $data['daftar_siswa']  = $this->siswaModel->getAll();

        $data['absensi']  = $this->absensiModel->find($id);

        if (!$data['absensi']) {
            http_response_code(404);
            require __DIR__ . '/../views/errors/404.php';
            return;
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/absensi/edit.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /absensi/update/{id} — simpan perubahan data absensi */
    public function update($id)
    {
        $this->absensiModel->update($id, $_POST);
        header('Location: ' . BASE_URL . 'absensi');
        exit;
    }

    /** GET /absensi/delete/{id} — hapus data absensi */
    public function delete($id)
    {
        $this->absensiModel->delete($id);
        header('Location: ' . BASE_URL . 'absensi');
        exit;
    }
}
