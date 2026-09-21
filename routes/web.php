<?php

/**
 * routes/web.php
 * Semua alamat (URL) aplikasi didaftarkan di sini, terpisah dari index.php.
 * Formatnya: $router->METHOD('/alamat-url', ['NamaController', 'namaMethod']);
 *
 * @var Router $router  (variabel $router dibuat di index.php)
 */

// ----------------------- Halaman Utama -----------------------
$router->get('/', ['HomeController', 'index']);

// ----------------------- CRUD Guru -----------------------
$router->get('/guru', ['GuruController', 'index']);
$router->get('/guru/create', ['GuruController', 'create']);
$router->post('/guru/store', ['GuruController', 'store']);
$router->get('/guru/edit/{id}', ['GuruController', 'edit']);
$router->post('/guru/update/{id}', ['GuruController', 'update']);
$router->get('/guru/delete/{id}', ['GuruController', 'delete']);

// ----------------------- CRUD Siswa -----------------------
$router->get('/siswa', ['SiswaController', 'index']);
$router->get('/siswa/create', ['SiswaController', 'create']);
$router->post('/siswa/store', ['SiswaController', 'store']);
$router->get('/siswa/edit/{id}', ['SiswaController', 'edit']);
$router->post('/siswa/update/{id}', ['SiswaController', 'update']);
$router->get('/siswa/delete/{id}', ['SiswaController', 'delete']);

// ----------------------- CRUD Kelas -----------------------
$router->get('/kelas', ['KelasController', 'index']);
$router->get('/kelas/create', ['KelasController', 'create']);
$router->post('/kelas/store', ['KelasController', 'store']);
$router->get('/kelas/edit/{id}', ['KelasController', 'edit']);
$router->post('/kelas/update/{id}', ['KelasController', 'update']);
$router->get('/kelas/delete/{id}', ['KelasController', 'delete']);

// ----------------------- CRUD Mapel -----------------------
$router->get('/mapel', ['MapelController', 'index']);
$router->get('/mapel/create', ['MapelController', 'create']);
$router->post('/mapel/store', ['MapelController', 'store']);
$router->get('/mapel/edit/{id}', ['MapelController', 'edit']);
$router->post('/mapel/update/{id}', ['MapelController', 'update']);
$router->get('/mapel/delete/{id}', ['MapelController', 'delete']);

// ----------------------- CRUD Jadwal -----------------------
$router->get('/jadwal', ['JadwalController', 'index']);
$router->get('/jadwal/create', ['JadwalController', 'create']);
$router->post('/jadwal/store', ['JadwalController', 'store']);
$router->get('/jadwal/edit/{id}', ['JadwalController', 'edit']);
$router->post('/jadwal/update/{id}', ['JadwalController', 'update']);
$router->get('/jadwal/delete/{id}', ['JadwalController', 'delete']);

// ----------------------- CRUD Nilai -----------------------
$router->get('/nilai', ['NilaiController', 'index']);
$router->get('/nilai/create', ['NilaiController', 'create']);
$router->post('/nilai/store', ['NilaiController', 'store']);
$router->get('/nilai/edit/{id}', ['NilaiController', 'edit']);
$router->post('/nilai/update/{id}', ['NilaiController', 'update']);
$router->get('/nilai/delete/{id}', ['NilaiController', 'delete']);

// ----------------------- CRUD Absensi -----------------------
$router->get('/absensi', ['AbsensiController', 'index']);
$router->get('/absensi/create', ['AbsensiController', 'create']);
$router->post('/absensi/store', ['AbsensiController', 'store']);
$router->get('/absensi/edit/{id}', ['AbsensiController', 'edit']);
$router->post('/absensi/update/{id}', ['AbsensiController', 'update']);
$router->get('/absensi/delete/{id}', ['AbsensiController', 'delete']);

// ----------------------- CRUD Tahun Ajaran -----------------------
$router->get('/tahun-ajaran', ['TahunAjaranController', 'index']);
$router->get('/tahun-ajaran/create', ['TahunAjaranController', 'create']);
$router->post('/tahun-ajaran/store', ['TahunAjaranController', 'store']);
$router->get('/tahun-ajaran/edit/{id}', ['TahunAjaranController', 'edit']);
$router->post('/tahun-ajaran/update/{id}', ['TahunAjaranController', 'update']);
$router->get('/tahun-ajaran/delete/{id}', ['TahunAjaranController', 'delete']);
