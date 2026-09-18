<?php
require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../models/Kelas.php'; // dipakai untuk dropdown kelas

class SiswaController
{
    private Siswa $siswaModel;
    private Kelas $kelasModel;

    public function __construct()
    {
        $this->siswaModel = new Siswa();
        $this->kelasModel = new Kelas();
    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['siswa'] = $this->siswaModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/siswa/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function create()
    {
        $data['title'] = 'Tambah Siswa';
        $data['daftar_kelas'] = $this->kelasModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/siswa/create.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function store()
    {
        $this->siswaModel->create($_POST);
        header('Location: ' . BASE_URL . 'siswa');
        exit;
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Siswa';
        $data['siswa'] = $this->siswaModel->find($id);
        $data['daftar_kelas'] = $this->kelasModel->getAll();

        if (!$data['siswa']) {
            http_response_code(404);
            require __DIR__ . '/../views/errors/404.php';
            return;
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/siswa/edit.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    public function update($id)
    {
        $this->siswaModel->update($id, $_POST);
        header('Location: ' . BASE_URL . 'siswa');
        exit;
    }

    public function delete($id)
    {
        $this->siswaModel->delete($id);
        header('Location: ' . BASE_URL . 'siswa');
        exit;
    }
}
