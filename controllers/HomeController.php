<?php
require_once __DIR__ . '/../models/Guru.php';
require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../models/Kelas.php';

class HomeController
{
    public function index()
    {
        $guruModel  = new Guru();
        $siswaModel = new Siswa();
        $kelasModel = new Kelas();

        $data['title']       = 'Beranda';
        $data['jumlah_guru']  = count($guruModel->getAll());
        $data['jumlah_siswa'] = count($siswaModel->getAll());
        $data['jumlah_kelas'] = count($kelasModel->getAll());

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/home/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}
