<?php
require_once __DIR__ . '/../models/TahunAjaran.php';

class TahunAjaranController
{
    private TahunAjaran $tahunAjaranModel;

    public function __construct()
    {
        $this->tahunAjaranModel = new TahunAjaran();
    }

    /** GET /tahun-ajaran — tampilkan semua data tahun_ajaran */
    public function index()
    {
        $data['title'] = 'Data TahunAjaran';
        $data['tahun_ajaran']  = $this->tahunAjaranModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/tahun-ajaran/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** GET /tahun-ajaran/create — tampilkan form tambah tahun_ajaran */
    public function create()
    {
        $data['title'] = 'Tambah TahunAjaran';

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/tahun-ajaran/create.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /tahun_ajaran/store — simpan data tahun_ajaran baru */
    public function store()
    {
        $this->tahunAjaranModel->create($_POST);
        header('Location: ' . BASE_URL . 'tahun-ajaran');
        exit;
    }

    /** GET /tahun-ajaran/edit/{id} — tampilkan form edit tahun_ajaran */
    public function edit($id)
    {
        $data['title'] = 'Edit TahunAjaran';
        $data['tahun_ajaran']  = $this->tahunAjaranModel->find($id);

        if (!$data['tahun_ajaran']) {
            http_response_code(404);
            require __DIR__ . '/../views/errors/404.php';
            return;
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/tahun-ajaran/edit.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /tahun-ajaran/update/{id} — simpan perubahan data tahun_ajaran */
    public function update($id)
    {
        $this->tahunAjaranModel->update($id, $_POST);
        header('Location: ' . BASE_URL . 'tahun-ajaran');
        exit;
    }

    /** GET /tahun-ajaran/delete/{id} — hapus data tahun_ajaran */
    public function delete($id)
    {
        $this->tahunAjaranModel->delete($id);
        header('Location: ' . BASE_URL . 'tahun-ajaran');
        exit;
    }
}
