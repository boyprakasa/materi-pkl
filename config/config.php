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

define('APP_NAME', $_ENV['APP_NAME']);
define('BASE_URL', $_ENV['BASE_URL']);
