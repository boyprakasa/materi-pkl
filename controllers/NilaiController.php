<?php
require_once __DIR__ . '/../models/Nilai.php';
require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../models/Mapel.php';
require_once __DIR__ . '/../models/Guru.php';

class NilaiController
{
    private Nilai $nilaiModel;
    private Siswa $siswaModel;
    private Mapel $mapelModel;
    private Guru $guruModel;

    public function __construct()
    {
        $this->nilaiModel = new Nilai();
        $this->siswaModel = new Siswa();
        $this->mapelModel = new Mapel();
        $this->guruModel = new Guru();
    }

    /** GET /nilai — tampilkan semua data nilai */
    public function index()
    {
        $data['title'] = 'Data Nilai';
        $data['nilai']  = $this->nilaiModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/nilai/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** GET /nilai/create — tampilkan form tambah nilai */
    public function create()
    {
        $data['title'] = 'Tambah Nilai';

        $data['daftar_siswa']  = $this->siswaModel->getAll();
        $data['daftar_mapel']  = $this->mapelModel->getAll();
        $data['daftar_guru']  = $this->guruModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/nilai/create.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /nilai/store — simpan data nilai baru */
    public function store()
    {
        $this->nilaiModel->create($_POST);
        header('Location: ' . BASE_URL . 'nilai');
        exit;
    }

    /** GET /nilai/edit/{id} — tampilkan form edit nilai */
    public function edit($id)
    {
        $data['title'] = 'Edit Nilai';

        $data['daftar_siswa']  = $this->siswaModel->getAll();
        $data['daftar_mapel']  = $this->mapelModel->getAll();
        $data['daftar_guru']  = $this->guruModel->getAll();

        $data['nilai']  = $this->nilaiModel->find($id);

        if (!$data['nilai']) {
            http_response_code(404);
            require __DIR__ . '/../views/errors/404.php';
            return;
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/nilai/edit.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /nilai/update/{id} — simpan perubahan data nilai */
    public function update($id)
    {
        $this->nilaiModel->update($id, $_POST);
        header('Location: ' . BASE_URL . 'nilai');
        exit;
    }

    /** GET /nilai/delete/{id} — hapus data nilai */
    public function delete($id)
    {
        $this->nilaiModel->delete($id);
        header('Location: ' . BASE_URL . 'nilai');
        exit;
    }
}
