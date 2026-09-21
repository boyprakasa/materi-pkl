<?php
require_once __DIR__ . '/../models/Mapel.php';

class MapelController
{
    private Mapel $mapelModel;

    public function __construct()
    {
        $this->mapelModel = new Mapel();
    }

    /** GET /mapel — tampilkan semua data mapel */
    public function index()
    {
        $data['title'] = 'Data Mapel';
        $data['mapel']  = $this->mapelModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/mapel/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** GET /mapel/create — tampilkan form tambah mapel */
    public function create()
    {
        $data['title'] = 'Tambah Mapel';

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/mapel/create.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /mapel/store — simpan data mapel baru */
    public function store()
    {
        $this->mapelModel->create($_POST);
        header('Location: ' . BASE_URL . 'mapel');
        exit;
    }

    /** GET /mapel/edit/{id} — tampilkan form edit mapel */
    public function edit($id)
    {
        $data['title'] = 'Edit Mapel';
        $data['mapel']  = $this->mapelModel->find($id);

        if (!$data['mapel']) {
            http_response_code(404);
            require __DIR__ . '/../views/errors/404.php';
            return;
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/mapel/edit.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /mapel/update/{id} — simpan perubahan data mapel */
    public function update($id)
    {
        $this->mapelModel->update($id, $_POST);
        header('Location: ' . BASE_URL . 'mapel');
        exit;
    }

    /** GET /mapel/delete/{id} — hapus data mapel */
    public function delete($id)
    {
        $this->mapelModel->delete($id);
        header('Location: ' . BASE_URL . 'mapel');
        exit;
    }
}
