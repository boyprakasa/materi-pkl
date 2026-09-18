<?php
require_once __DIR__ . '/../models/Kelas.php';
require_once __DIR__ . '/../models/Guru.php'; // dipakai untuk dropdown wali kelas

class KelasController
{
    private Kelas $kelasModel;
    private Guru $guruModel;

    public function __construct()
    {
        $this->kelasModel = new Kelas();
        $this->guruModel  = new Guru();
    }

    public function index()
    {
        $data['title'] = 'Data Kelas';
        $data['kelas'] = $this->kelasModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/kelas/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function create()
    {
        $data['title'] = 'Tambah Kelas';
        $data['daftar_guru'] = $this->guruModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/kelas/create.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function store()
    {
        $this->kelasModel->create($_POST);
        header('Location: ' . BASE_URL . 'kelas');
        exit;
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Kelas';
        $data['kelas'] = $this->kelasModel->find($id);
        $data['daftar_guru'] = $this->guruModel->getAll();

        if (!$data['kelas']) {
            http_response_code(404);
            require __DIR__ . '/../views/errors/404.php';
            return;
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/kelas/edit.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function update($id)
    {
        $this->kelasModel->update($id, $_POST);
        header('Location: ' . BASE_URL . 'kelas');
        exit;
    }

    public function delete($id)
    {
        $this->kelasModel->delete($id);
        header('Location: ' . BASE_URL . 'kelas');
        exit;
    }
}
