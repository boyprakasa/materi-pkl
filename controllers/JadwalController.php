<?php
require_once __DIR__ . '/../models/Jadwal.php';
require_once __DIR__ . '/../models/Kelas.php';
require_once __DIR__ . '/../models/Mapel.php';
require_once __DIR__ . '/../models/Guru.php';

class JadwalController
{
    private Jadwal $jadwalModel;
    private Kelas $kelasModel;
    private Mapel $mapelModel;
    private Guru $guruModel;

    public function __construct()
    {
        $this->jadwalModel = new Jadwal();
        $this->kelasModel = new Kelas();
        $this->mapelModel = new Mapel();
        $this->guruModel = new Guru();
    }

    /** GET /jadwal — tampilkan semua data jadwal */
    public function index()
    {
        $data['title'] = 'Data Jadwal';
        $data['jadwal']  = $this->jadwalModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/jadwal/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** GET /jadwal/create — tampilkan form tambah jadwal */
    public function create()
    {
        $data['title'] = 'Tambah Jadwal';

        $data['daftar_kelas']  = $this->kelasModel->getAll();
        $data['daftar_mapel']  = $this->mapelModel->getAll();
        $data['daftar_guru']  = $this->guruModel->getAll();

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/jadwal/create.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /jadwal/store — simpan data jadwal baru */
    public function store()
    {
        $this->jadwalModel->create($_POST);
        header('Location: ' . BASE_URL . 'jadwal');
        exit;
    }

    /** GET /jadwal/edit/{id} — tampilkan form edit jadwal */
    public function edit($id)
    {
        $data['title'] = 'Edit Jadwal';
        $data['jadwal']  = $this->jadwalModel->find($id);

        if (!$data['jadwal']) {
            http_response_code(404);
            require __DIR__ . '/../views/errors/404.php';
            return;
        }

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/jadwal/edit.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** POST /jadwal/update/{id} — simpan perubahan data jadwal */
    public function update($id)
    {
        $this->jadwalModel->update($id, $_POST);
        header('Location: ' . BASE_URL . 'jadwal');
        exit;
    }

    /** GET /jadwal/delete/{id} — hapus data jadwal */
    public function delete($id)
    {
        $this->jadwalModel->delete($id);
        header('Location: ' . BASE_URL . 'jadwal');
        exit;
    }
}
