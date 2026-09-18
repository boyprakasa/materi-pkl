<?php
require_once __DIR__ . '/../models/Guru.php';

class GuruController
{
    private Guru $guruModel;

    public function __construct()
    {
        $this->guruModel = new Guru();
    }

    /** GET /guru — tampilkan semua data guru */
    public function index()
    {
        $data['title'] = 'Data Guru';
        $data['guru']  = $this->guruModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/guru/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** GET /guru/create — tampilkan form tambah guru */
    public function create()
    {
        $data['title'] = 'Tambah Guru';

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/guru/create.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /guru/store — simpan data guru baru */
    public function store()
    {
        $this->guruModel->create($_POST);
        header('Location: ' . BASE_URL . 'guru');
        exit;
    }

    /** GET /guru/edit/{id} — tampilkan form edit guru */
    public function edit($id)
    {
        $data['title'] = 'Edit Guru';
        $data['guru']  = $this->guruModel->find($id);

        if (!$data['guru']) {
            http_response_code(404);
            require __DIR__ . '/../views/errors/404.php';
            return;
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/guru/edit.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /guru/update/{id} — simpan perubahan data guru */
    public function update($id)
    {
        $this->guruModel->update($id, $_POST);
        header('Location: ' . BASE_URL . 'guru');
        exit;
    }

    /** GET /guru/delete/{id} — hapus data guru */
    public function delete($id)
    {
        $this->guruModel->delete($id);
        header('Location: ' . BASE_URL . 'guru');
        exit;
    }
}
