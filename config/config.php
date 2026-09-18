<?php

/**
 * config/config.php
 * Pengaturan umum aplikasi.
 *
 * BASE_URL wajib disesuaikan jika aplikasi diletakkan di dalam subfolder.
 * Contoh:
 *   - Jika dijalankan lewat "php -S localhost:8000" -> biarkan '/'
 *   - Jika diletakkan di htdocs/sekolah-app/       -> ubah jadi '/sekolah-app/'
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

define('APP_NAME', $_ENV['APP_NAME']);
define('BASE_URL', $_ENV['BASE_URL']);
