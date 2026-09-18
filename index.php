<?php
/**
 * =====================================================================
 *  index.php — TUMPUAN APLIKASI
 * =====================================================================
 *  File ini adalah SATU-SATUNYA pintu masuk (front controller) aplikasi.
 *  Semua request (baik itu /guru, /siswa, /kelas, dst) akan selalu
 *  lewat file ini terlebih dahulu.
 *
 *  Tugas index.php di sini:
 *   1. Menyalakan session
 *   2. Memuat CONFIG (pengaturan aplikasi & koneksi database)
 *   3. Memuat CORE (Router sederhana buatan sendiri)
 *   4. Mendaftarkan semua ROUTE (alamat URL) lewat routes/web.php
 *   5. Menjalankan (dispatch) route yang cocok dengan URL yang diminta
 *
 *  Catatan: index.php TIDAK berisi logic CRUD sama sekali.
 *  Logic CRUD ada di controllers/ dan models/, sedangkan tampilan
 *  (style/Bootstrap) ada di views/layouts/header.php & footer.php.
 *  index.php hanya jadi "tumpuan" yang menyatukan semuanya.
 * =====================================================================
 */

session_start();

// ---------------------------------------------------------------------
// 1. CONFIG (pengaturan aplikasi + koneksi database)
// ---------------------------------------------------------------------
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// ---------------------------------------------------------------------
// 2. CORE (Router buatan sendiri, bukan framework)
// ---------------------------------------------------------------------
require_once __DIR__ . '/core/Router.php';

$router = new Router();

// ---------------------------------------------------------------------
// 3. DAFTAR ROUTE
//    Semua alamat URL didaftarkan terpisah di routes/web.php,
//    supaya index.php tetap bersih dan rapi.
// ---------------------------------------------------------------------
require_once __DIR__ . '/routes/web.php';

// ---------------------------------------------------------------------
// 4. JALANKAN ROUTER
// ---------------------------------------------------------------------
$method = $_SERVER['REQUEST_METHOD'];
$uri    = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $uri);
